<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - About Us</title>
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
        <h1 id="h">About Us</h1>
        <p id="p1">
            Welcome to Shoe Haven, your ultimate destination for stylish, comfortable, and high-quality footwear. We are passionate about shoes and believe that the right pair can transform your look, elevate your confidence, and make a lasting impression. Our curated collection features a wide range of designs, from trendy sneakers and elegant heels to versatile flats and durable boots, ensuring there's something for every occasion and style.<br><br>

            At Shoe Haven, we are committed to providing exceptional customer service and a seamless shopping experience. Our team meticulously selects each pair of shoes, prioritizing quality, craftsmanship, and contemporary design. We believe that shopping for shoes should be enjoyable and hassle-free, which is why we offer easy navigation, secure payment options, and fast shipping.<br><br>

            Join our community of shoe enthusiasts and step into a world of fashion and comfort. Thank you for choosing Shoe Haven, where every step matters.
        </p>
    </div>
</body>
</html>
