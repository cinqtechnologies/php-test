#!/bin/bash

touch .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
cat > .git/hooks/pre-commit <<EOF
#!/bin/bash

refname=\$(git symbolic-ref HEAD)

if [[ "\$refname" = "refs/heads/master" ]]
then
    echo ""
    echo " xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    echo " x                                                   x"
    echo " x     Commits on master branch are not allowed      x
    echo " x                                                   x"
    echo " xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    echo ""
    exit 1
fi
EOF
