<?php
include_once "retailer.php";

class Product {
	// Config
    private $connection;
    private $table_name = "products";
	
	// Properties
	public $id;
	public $id_retailer;
	public $name;
	public $price;
	public $image;
	public $description;
	
	// Constructor
	public function __construct($connection){
        $this->connection = $connection;
    }
	
	// GET
	public function get () {
		$query =
			"SELECT
				id, id_retailer, name, price, image, description
			FROM
				" . $this->table_name . "
			WHERE
				id = :id";

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();

		if ($row = $stmt->fetch()) {		
			$this->id_retailer = $row['id_retailer'];
			$this->name = $row['name'];
			$this->price = $row['price'];
			$this->image = $row['image'];
			$this->description = $row['description'];
			
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
				(id_retailer, name, price, image, description)
			VALUES
				(:id_retailer, :name, :price, :image, :description)";

		$this->sanitize();
		
		$retainer = new Retailer($this->connection);
		$retainer->id = $this->id_retailer;
		if (!$retainer->get()) {
			return false;
		}

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":id_retailer", $this->id_retailer);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":description", $this->description);
		
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
				id, id_retailer, name, price, image, description
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
				id_retailer = :id_retailer, name = :name, price = :price, image = :image, description = :description
			WHERE
				id = :id";

		$this->sanitize();
		
		$retainer = new Retailer($this->connection);
		$retainer->id = $this->id_retailer;
		if (!$retainer->get()) {
			return false;
		}

		$stmt = $this->connection->prepare($query);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":id_retailer", $this->id_retailer);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":description", $this->description);
		
		if (!$stmt->execute())
			return false;

		return true;
	}

	public function delete () {
		return false;
	}

	// Custom search
	public function search_by_retailer ($id_retailer) {
		$query =
			"SELECT
				id, id_retailer, name, price, image, description
			FROM
				" . $this->table_name . "
			WHERE
				id_retailer = " . $id_retailer . "
			ORDER BY
				id";

		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	// Other functions
	private function sanitize () {
		$this->id = intval($this->id);
		$this->id_retailer = intval($this->id_retailer);
		$this->name = strip_tags($this->name);
		$this->price = floatval($this->price);
		$this->image = strip_tags($this->image);
		$this->description = strip_tags($this->description);
	}

	public function to_array () {
		return [
			"id" => $this->id,
			"id_retailer" => $this->id_retailer,
			"name" => $this->name,
			"price" => $this->price,
			"image" => $this->image,
			"description" => $this->description
		];
	}
}