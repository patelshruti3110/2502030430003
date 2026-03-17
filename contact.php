<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Contact</title>
    <style>
        body, h1, p {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        .page-wrapper {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        #h {
            color: black;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 30px;
        }

        #p1 {
            font-size: 1.25rem;
            color: #555;
            margin: 0 auto;
            max-width: 800px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 30px 15px;
            }

            #h {
                font-size: 2.2rem;
            }

            #p1 {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="page-wrapper">
        <h1 id="h">Contact</h1>
        <p id="p1">
            <strong>Address:</strong> XYZ Main Street<br><br>
            <strong>Email:</strong> contact@shoehaven.com<br><br>
            <strong>Contact number:</strong> 90909xxxxx<br><br>
            <strong>WhatsApp number:</strong> 9090xxxxx
        </p>
    </div>
</body>
</html>
