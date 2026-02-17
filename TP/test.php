<?php
declare(strict_types=1);

require_once "Category.php";
require_once "Product.php";

$catArmes = new Category(1, "Armes", "Armes gobelines instables");
$catPotions = new Category(2, "Potions", "Potions douteuses");

$prod1 = new Product(1, "Dague rouillée", 9.99, $catArmes, 10);
$prod2 = new Product(2, "Potion de chance", 19.50, $catPotions, 0);

echo $catArmes->getName();
echo "";
echo $catPotions->getName();
echo "";

$prod1->showDetails();
$prod2->showDetails();
