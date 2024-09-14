<?php
class InquiryController extends Controller {

    public function inquiries() {
        $inquiries = $this->model('InquiryModel')->getAllInquiries();
        foreach ($inquiries as &$inquiry) {
            $inquiry['status_history'] = $this->model('InquiryModel')->getStatusHistory($inquiry['inquiry_id']);
        }
        $this->renderView('admin/inquiries', ['inquiries' => $inquiries]);
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inquiry_id = htmlspecialchars(trim($_POST['inquiry_id']));
            $status = htmlspecialchars(trim($_POST['status']));
            $this->model('InquiryModel')->updateInquiryStatus($inquiry_id, $status, 'Admin User');
            header('Location: /clothing-store/public/admin/inquiries');
            exit();
        }
    }

    public function editInquiry() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inquiry_id = htmlspecialchars(trim($_POST['inquiry_id']));
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'contact_number' => htmlspecialchars(trim($_POST['contact_number'])),
                'subject' => htmlspecialchars(trim($_POST['subject'])),
                'message' => htmlspecialchars(trim($_POST['message'])),
                'status' => htmlspecialchars(trim($_POST['status'])),
            ];

            // Get the current status to check if it has changed
            $current_inquiry = $this->model('InquiryModel')->getInquiryById($inquiry_id);
            if ($current_inquiry['status'] != $data['status']) {
                // Prevent changing status from 'complete' to 'pending' without confirmation
                if ($current_inquiry['status'] == 'complete' && $data['status'] == 'pending') {
                    // Handle the confirmation logic here (for simplicity, we update directly)
                }
                // Log the status change in the history
                $this->model('InquiryModel')->updateInquiryStatus($inquiry_id, $data['status'], 'Admin User');
            }

            // Update inquiry details in the inquiries table
            $this->model('InquiryModel')->updateInquiry($inquiry_id, $data);
            header('Location: /clothing-store/public/admin/inquiries');
            exit();
        }
    }

    public function deleteInquiry() {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            $this->model('InquiryModel')->deleteInquiry($id);
            header('Location: /clothing-store/public/admin/inquiries');
        }
    }
}
