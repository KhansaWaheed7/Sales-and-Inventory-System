<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sales and Inventory System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            color: #fff;
        }
        .hero-section {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            padding: 50px 30px;
            border-radius: 15px;
            margin-top: 60px;
            backdrop-filter: blur(10px);
        }
        .hero-text h3 {
            font-weight: 900;
            font-size: 3rem;
            letter-spacing: 1.5px;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.4);
        }
        .hero-text p {
            font-size: 1.25rem;
            line-height: 1.6;
            color: #e0e7ff;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
        }
        .hero-image img {
            max-width: 80%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }
        .hero-image img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 45px rgba(0,0,0,0.5);
        }
        @media (max-width: 767px) {
            .hero-text h3 {
                font-size: 2.2rem;
            }
            .hero-text p {
                font-size: 1rem;
            }
            .hero-section {
                padding: 30px 15px;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>

<div class="container hero-section">
    <div class="row align-items-center">
        <!-- Text Section -->
        <div class="col-md-6 hero-text">
            <h3>Sales and Inventory System</h3>
            <p>
                A simple yet efficient cashiering system to help businesses manage their daily transactions.
                Designed for both administrators and cashiers, enabling seamless product management, real-time billing,
                and easy access to transaction history.
            </p>
        </div>

        <!-- Image Section -->
        <div class="col-md-6 hero-image text-center">
            <img src="https://media.istockphoto.com/id/1291913027/vector/contactless-mobile-payment-for-purchases-via-nfc-people-shopping-social-distancing-and.jpg?s=612x612&w=0&k=20&c=rNlEX06bQ2t9NHf_d1sLQ4r4lGrdx4S3dhfTrBQUTpg=" alt="POS System" />
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
