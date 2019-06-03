<?php
class Retailer {
	// Config
    private $connection;
    private $table_name = "retailers";

	// Properties
	public $id;
	public $name;
	public $logo;
	public $description;
	public $website;

	// Constructor
	public function __construct($connection){
        $this->connection = $connection;
    }

	// GET
	public function get () {
		$query =
			"SELECT
				id, name, logo, description, website
			FROM
				" . $this->table_name . "
			WHERE
				id = :id";

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();

		if ($row = $stmt->fetch()) {
			$this->name = $row["name"];
			$this->logo = $row["logo"];
			$this->description = $row["description"];
			$this->website = $row["website"];

			return true;
		}
		else {
			return false;
		}
	}

	// CRUD
	public function create () {
		$query =
			"INSERT INTO " . $this->table_name .  "
				(name, logo, description, website)
			VALUES
				(:name, :logo, :description, :website)";

		$this->sanitize();

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":logo", $this->logo);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":website", $this->website);

		if (!$stmt->execute())
			return false;

		$id = $this->connection->lastInsertId();
		if (!$id)
			return false;
		$this->id = $id;

		return true;
	}

	public function read () {
		$query =
			"SELECT
				id, name, logo, description, website
			FROM
				" . $this->table_name . "
			ORDER BY
				id";

		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function update () {
		$query =
			"UPDATE
				" . $this->table_name .  "
			SET
				name = :name, logo = :logo, description = :description, website = :website
			WHERE
				id = :id";

		$this->sanitize();

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":logo", $this->logo);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":website", $this->website);

		if (!$stmt->execute())
			return false;

		return true;
	}

	public function delete () {
		return false;
	}

	// Other functions
	private function sanitize () {
		// $this->id = intval($this->id);
		$this->name = strip_tags($this->name);
		$this->logo = empty($this->logo) ? null : strip_tags($this->logo);
		$this->description = empty($this->description) ? null : strip_tags($this->description);
		$this->website = empty($this->website) ? null : strip_tags($this->website);
	}

	public function to_array () {
		return [
			"id" => $this->id,
			"name" => $this->name,
			"logo" => $this->logo,
			"description" => $this->description,
			"website" => $this->website
		];
	}
}