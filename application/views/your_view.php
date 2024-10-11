<!-- application/views/your_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .notification {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            display: none;
        }
    </style>
</head>
<body>

<?php if ($this->session->flashdata('notification')): ?>
    <div class="alert alert-info notification" id="notification">
        <?= $this->session->flashdata('notification'); ?>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'block';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 5000); // Notifikasi akan hilang setelah 5 detik
        }
    });
</script>

</body>
</html>
