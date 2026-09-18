<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>403 - Unauthorized Access</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Arial, Helvetica, sans-serif;

            /* Background based on the image */
            background: radial-gradient(
                circle at 0% 0%,
                rgba(174, 180, 255, 0.45) 0,
                rgba(174, 180, 255, 0) 25%
            ),
            radial-gradient(
                circle at 100% 100%,
                rgba(166, 205, 255, 0.45) 0,
                rgba(166, 205, 255, 0) 28%
            ),
            linear-gradient(
                135deg,
                #f7f9ff 0%,
                #ffffff 45%,
                #edf6ff 100%
            );

            overflow: hidden;
        }

        /*
        |----------------------------------------------------------
        | Decorative background shapes
        |----------------------------------------------------------
        */

        .shape {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }

        .shape-top-left {
            width: 420px;
            height: 420px;
            top: -260px;
            left: -170px;

            background: rgba(168, 175, 255, 0.20);
        }

        .shape-bottom-right {
            width: 500px;
            height: 500px;
            right: -280px;
            bottom: -280px;

            background: rgba(158, 200, 255, 0.20);
        }

        .shape-small-one {
            width: 18px;
            height: 18px;
            top: 10%;
            right: 8%;

            background: rgba(91, 143, 249, 0.45);
        }

        .shape-small-two {
            width: 28px;
            height: 28px;
            bottom: 15%;
            left: 7%;

            background: rgba(139, 139, 247, 0.35);
        }

        /*
        |----------------------------------------------------------
        | Main content
        |----------------------------------------------------------
        */

        .error-page {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 850px;

            padding: 30px 20px;

            text-align: center;
        }

        .error-image {
            display: block;

            width: 100%;
            max-width: 650px;

            height: auto;

            margin: 0 auto 10px;
        }

        /*
        |----------------------------------------------------------
        | Dashboard button
        |----------------------------------------------------------
        */

        .dashboard-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 10px;

            min-width: 220px;

            padding: 14px 28px;

            border-radius: 12px;

            background: linear-gradient(
                135deg,
                #4f8df7 0%,
                #3048ed 100%
            );

            color: #ffffff;

            text-decoration: none;

            font-size: 16px;
            font-weight: 600;

            box-shadow: 0 10px 25px rgba(54, 91, 235, 0.25);

            transition: transform 0.2s ease,
            box-shadow 0.2s ease;
        }

        .dashboard-button:hover {
            color: #ffffff;

            transform: translateY(-2px);

            box-shadow: 0 14px 30px rgba(54, 91, 235, 0.32);
        }

        .dashboard-button:active {
            transform: translateY(0);
        }

        .arrow {
            font-size: 21px;
            line-height: 1;
        }

        /*
        |----------------------------------------------------------
        | Mobile
        |----------------------------------------------------------
        */

        @media (max-width: 768px) {

            .error-page {
                padding: 20px;
            }

            .error-image {
                max-width: 520px;
            }

            .dashboard-button {
                min-width: 200px;
                padding: 13px 22px;
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {

            .error-image {
                max-width: 360px;
            }

            .dashboard-button {
                width: 100%;
                max-width: 250px;
            }

            .shape-top-left {
                width: 280px;
                height: 280px;
                top: -180px;
                left: -150px;
            }

            .shape-bottom-right {
                width: 320px;
                height: 320px;
                right: -200px;
                bottom: -200px;
            }
        }
    </style>
</head>

<body>

<!-- Decorative background -->
<div class="shape shape-top-left"></div>
<div class="shape shape-bottom-right"></div>
<div class="shape shape-small-one"></div>
<div class="shape shape-small-two"></div>

<main class="error-page">

    <!-- 403 Illustration -->
    <img
        src="{{ asset('images/403-unauthorized-access.svg') }}"
        alt="403 Unauthorized Access"
        class="error-image"
    >

    <!-- Back to Dashboard -->
    <a
        href="{{ route('dashboard') }}"
        class="dashboard-button"
    >
        <span class="arrow">←</span>
        <span>Back to Dashboard</span>
    </a>

</main>

</body>
</html>
