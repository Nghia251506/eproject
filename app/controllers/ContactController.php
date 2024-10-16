<?php

class ContactController extends BaseController
{
    private $__contactModel;
    public function __construct($conn)
    {
        $this->__contactModel = $this->initModel("ContactModel", $conn);
    }

    public function index()
    {
        $this->view("layouts/client", ["page"=> "contact"]);
    }

    public function list($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $contacts = $this->__contactModel->getAllContact($limit, $offset);
        $totalContacts = $this->__contactModel->countAllPContacts();
        $totalPages = ceil($totalContacts / $limit); // Total number of pages
        $this->view("layouts/admin", [
            "page" => "listContact",
            "contacts" => $contacts,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ]);
    }

    public function add(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and clean data
            // $id = trim($_POST["id"]) ?? null;
            $name = trim($_POST["name"]);
            $phone_number = trim($_POST["phone_number"]);
            $email = trim($_POST["email"]);
            $company = trim($_POST["company"]);
            $title = trim($_POST["title"]);
            $question = trim($_POST["question"]);

            // Check input (For example: check for empty, valid, ...)
            // if (empty($name) || empty($address) || empty($phone_number) || empty($email) || empty($company) ||  empty($question) ) {
                
            //     echo "Please fill in complete product information.";
            //     return;
            // }
            
            // Call the saveProduct function from the model
            
                $contact = $this->__contactModel->addContact($name, $phone_number, $email, $company,$title, $question);
                if ($contact) {
                header("Location: http://localhost/eproject/contact/index");
                exit();
            } else {
                // Error message if save fails
                echo "An error occurred while sending the contact. Please try again.";
            }
        }
    }
}
