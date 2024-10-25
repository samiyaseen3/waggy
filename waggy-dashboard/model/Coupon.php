<?php
require_once 'model/Database.php'; 

class Coupon {
    private $conn;



    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }




    public function getAllCoupons() {
        $query = "SELECT * FROM coupon WHERE is_deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public function addCoupon($discount, $expiry_date, $status) {
        $query = "INSERT INTO coupon (coupon_discount, coupon_expiry_date, coupon_status) VALUES (:discount, :expiry_date, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':expiry_date', $expiry_date);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }


    public function updateCoupon($id, $discount, $expiry_date, $status) {
        $query = "UPDATE coupon SET coupon_discount = :discount, coupon_expiry_date = :expiry_date, coupon_status = :status WHERE coupon_id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':expiry_date', $expiry_date);
        $stmt->bindParam(':status', $status);
        
        return $stmt->execute();
    }


    public function deleteCoupon($id) {
    $query = "UPDATE coupon SET is_deleted = 1 WHERE coupon_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

    
}
?>