<?php
session_start();

require 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: user-sign-in.php');
    exit; // Exit after redirection
}

// Get user ID (assuming it's stored in $_SESSION['user_id'])
$userId = $_SESSION['user_id']; 

// Fetch user messages using stored procedure
try {
    $stmt = $connection->prepare("CALL sp_GetMessagesByUserId(?)");
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();
    $chats = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    // Handle database errors gracefully
    echo "Database Error: " . $e->getMessage();
    exit; 
}

// Fetch admin information (if not already available)
$admin = [];
if (!isset($_SESSION['admin_id'])) {
    try {
        $sql = "SELECT * FROM v_select_admin";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        // Handle database errors gracefully
        echo "Database Error: " . $e->getMessage();
        exit; 
    }
}

// ... (Rest of your code to process $chats and $admin) ... 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/cargo-logo-assets/CarGo-Large.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-success" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="user-vehicles.php">VEHICLES</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-success" href="<?php if (!isset($_SESSION["email"])) {
                                                                    echo "user-sign-in.php";
                                                                } else {
                                                                    echo "user-chats.php";
                                                                } ?>"><?php if (!isset($_SESSION["email"])) {
                                                                            echo "SIGN IN";
                                                                        } else {
                                                                            echo "PROFILE";
                                                                        }
                                                                        ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row">

            <aside class="col-12 col-md-3 col-lg-2 bg-light p-3 d-flex flex-column mt-5 rounded" style="height: max-content;">
                <ul class="nav flex-column">
                    <li class="nav-item mb-3 bg-success rounded">
                        <a class="nav-link text-white" href="user-chats.php"><i class="bi bi-chat-dots me-2"></i>Chats</a>
                    </li>
                    <li class="nav-item mb-3 ">
                        <a class="nav-link text-dark" href="user-billing-history.php"><i class="bi bi-receipt me-2"></i>Billing History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="user-profile.php"><i class="bi bi-person-circle me-2"></i>Profile</a>
                    </li>
                </ul>
            </aside>

            <div class="col-12 col-md-9 col-lg-10 d-flex flex-column p-4">

                <h3 class="text-start">Chats</h3>
                <div class="container d-flex flex-column bg-light p-0" style="max-width: 100%; height: 75vh; border: 1px solid #ddd; border-radius: 8px;">

                    <div id="chat-content" class="flex-grow-1 p-3 overflow-auto d-flex flex-column-reverse">
                        <?php if (isset($_SESSION['admin_id'])): ?>
                            <?php foreach ($chats as $chat) {
                                if ($chat->sender_id === $_SESSION['user_id']) {
                            ?>
                                    <!-- Chat Sent -->
                                    <div class="d-flex justify-content-end mb-3">
                                        <div class="p-3 bg-success text-white rounded-3" style="max-width: 75%;">
                                            <p class="mb-0"><?php echo $chat->content ?></p>
                                            <small class="text-white-50"><?php echo date('h:i A', strtotime($chat->sent_at)) ?></small>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Chat Received -->

                                <?php if ($chat->sender_id !== $_SESSION['user_id']) { ?>
                                    <div class="d-flex mb-3">
                                        <div class="p-3 bg-body-secondary rounded-3" style="max-width: 75%;">
                                            <p class="mb-0"><?php echo $chat->content ?></p>
                                            <small class="text-muted"><?php echo date('h:i A', strtotime($chat->sent_at)) ?></small>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php endif; ?>

                        <?php if (!isset($_SESSION['admin_id'])): ?>
                            <?php foreach ($chats as $chat) {
                                if ($chat->sender_id === $_SESSION['user_id']) {
                            ?>
                                    <!-- Chat Sent -->
                                    <div class="d-flex justify-content-end mb-3">
                                        <div class="p-3 bg-success text-white rounded-3" style="max-width: 75%;">
                                            <p class="mb-0"><?php echo $chat->content ?></p>
                                            <small class="text-white-50"><?php echo date('h:i A', strtotime($chat->sent_at)) ?></small>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Chat Received -->

                                <?php if ($chat->role == $admin['role']) { ?>
                                    <div class="d-flex mb-3">
                                        <div class="p-3 bg-body-secondary rounded-3" style="max-width: 75%;">
                                            <p class="mb-0"><?php echo $chat->content ?></p>
                                            <small class="text-muted"><?php echo date('h:i A', strtotime($chat->sent_at)) ?></small>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php endif; ?>
                        

                    </div>
                    <form action="user-chats-logic.php" method="POST">
                        <div class="p-3 border-top">
                            <div class="input-group">
                                <input type="text" minlength="1" class="form-control" name="message-content" placeholder='Aa' aria-label="Type a message">
                                <input type="hidden" value="<?php echo $_SESSION['admin_id'] ?? $admin['Account_ID'] ?>" name="hiddenAdminID">
                                <button class="btn btn-success" type="submit"><i class="bi bi-send-fill"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </main>

</body>

</html>