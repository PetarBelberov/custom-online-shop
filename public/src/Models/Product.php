<?php
namespace Models;

use PDO;

class Product
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProducts(): bool|array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveProduct($userId, $productName, $productDescription, $productPublicationDate, $productImages): void
    {
        // Serialize the $productImages array into a JSON string representation.
        $productImagesJson = json_encode($productImages);

        // Insert the product into the database.
        $stmt = $this->pdo->prepare("INSERT INTO products (user_id, name, description, publication_date, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $productName, $productDescription, $productPublicationDate, $productImagesJson]);

    }

    public function getProductById($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($productId, $productName, $productDescription, $productPublicationDate, $productImages): void
    {
        // Serialize the $productImages array into a JSON string representation.
        $productImagesJson = json_encode($productImages);

        // Update the product in the database.
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, description = ?, publication_date = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$productName, $productDescription, $productPublicationDate, $productImagesJson, $productId]);
    }

    public function deleteProduct($productId): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$productId]);
    }
}