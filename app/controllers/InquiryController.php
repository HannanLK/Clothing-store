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

    // Display the contact form to the user
    public function showContactForm() {
        // Render the contact form view (ensure this view is created in the customer folder)
        $this->renderView('customer/contact');
    }

    // Handle form submission from the contact page
    public function submitContactForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate the input fields
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                'contact_number' => htmlspecialchars(trim($_POST['contact_number'])),
                'subject' => htmlspecialchars(trim($_POST['subject'])),
                'message' => htmlspecialchars(trim($_POST['message'])),
                'status' => 'pending',  // Status is automatically set to 'pending'
                'created_at' => date('Y-m-d H:i:s')
            ];

            if (!$data['email']) {
                // If email validation fails, redirect back with an error
                $this->renderView('customer/contact', ['error' => 'Invalid email address']);
                return;
            }

            // Insert the inquiry into the database
            $inquiryModel = $this->model('InquiryModel');
            $inquiryModel->addInquiry($data);

            // Redirect to a thank you page or back to the contact form
            header('Location: ' . BASE_URL . 'contact/thankYou');
            exit;
        } else {
            // If it's not a POST request, just show the form again
            $this->renderView('customer/contact');
        }
    }

    

}
