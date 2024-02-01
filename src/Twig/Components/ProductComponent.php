<?php

namespace App\Twig\Components;

use App\Entity\Category;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ProductComponent
{
    public string $name;
    public Category $category;
    public float $price;
    public string $description;
}
