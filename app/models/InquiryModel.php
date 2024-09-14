<?php
class InquiryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Fetch all inquiries with status and history
    public function getAllInquiries() {
        $this->db->query("SELECT * FROM inquiries");
        return $this->db->resultSet();
    }

    public function getInquiryById($inquiry_id) {
        $this->db->query("SELECT * FROM inquiries WHERE inquiry_id = :inquiry_id");
        $this->db->bind(':inquiry_id', $inquiry_id);
        return $this->db->single();
    }

    // Update the inquiry status
    public function updateInquiryStatus($inquiry_id, $status, $changed_by) {
        $this->db->query("UPDATE inquiries SET status = :status, updated_at = NOW() WHERE inquiry_id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $inquiry_id);
        $this->db->execute();

        // Log status change in the history
        $this->logStatusChange($inquiry_id, $status, $changed_by);
    }

    public function updateInquiry($inquiry_id, $data) {
        $this->db->query("UPDATE inquiries SET name = :name, email = :email, contact_number = :contact_number, 
                          subject = :subject, message = :message, status = :status, updated_at = NOW() 
                          WHERE inquiry_id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $inquiry_id);
        return $this->db->execute();
    }

    // Log status changes for history
    private function logStatusChange($inquiry_id, $status, $changed_by) {
        $this->db->query("INSERT INTO inquiry_status_history (inquiry_id, new_status, changed_at, changed_by) 
                          VALUES (:inquiry_id, :status, NOW(), :changed_by)");
        $this->db->bind(':inquiry_id', $inquiry_id);
        $this->db->bind(':status', $status);
        $this->db->bind(':changed_by', $changed_by);
        $this->db->execute();
    }

    // Fetch status history for an inquiry
    public function getStatusHistory($inquiry_id) {
        $this->db->query("SELECT * FROM inquiry_status_history WHERE inquiry_id = :inquiry_id ORDER BY changed_at DESC");
        $this->db->bind(':inquiry_id', $inquiry_id);
        return $this->db->resultSet();
    }

    // Delete an inquiry
    public function deleteInquiry($id) {
        $this->db->query("DELETE FROM inquiries WHERE inquiry_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
