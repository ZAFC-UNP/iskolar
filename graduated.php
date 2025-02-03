<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    $page_title="Account Creation Failed";
    include('includes/header.php');
    ?>
    <style>
        body {
            background: #1488EA;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        #card {
            position: relative;
            width: 320px;
            display: block;
            text-align: center;
            font-family: "Source Sans Pro", sans-serif;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
        }
        #upper-side {
            padding: 2em;
            background-color: #cc1a1a;
            color: #fff;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }
        #checkmark {
            font-weight: lighter;
            fill: #fff;
            margin: -3.5em auto auto 20px;
        }
        #status {
            font-weight: lighter;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1em;
            margin-top: -0.2em;
            margin-bottom: 0;
        }
        #lower-side {
            padding: 2em;
            background: #fff;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        #message {
            margin-top: -0.5em;
            color: #757575;
            letter-spacing: 1px;
        }
        .loader {
            width: 25px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #25b09b;
            --_m: 
                conic-gradient(#0000 10%,#000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
                    mask: var(--_m);
            -webkit-mask-composite: source-out;
                    mask-composite: subtract;
            animation: l3 1s infinite linear;
            margin: auto;
        }
        @keyframes l3 {
            to {
                transform: rotate(1turn);
            }
        }
    </style>
</head>
<body>
    <div id="card">
        <div id="upper-side">
            <!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
            <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
            <svg
                version="1.1"
                id="checkmark"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                xml:space="preserve"
            >
                <line x1="90" y1="90" x2="130" y2="120" stroke="#ffffff" stroke-width="5"/>
                <line x1="90" y1="120" x2="130" y2="90" stroke="#ffffff" stroke-width="5"/>
                <circle
                    fill="none"
                    stroke="#ffffff"
                    stroke-width="5"
                    stroke-miterlimit="10"
                    cx="109.486"
                    cy="104.353"
                    r="32.53"
                />
            </svg>
            <h3 id="status">CONGRATULATIONS!!</h3>
        </div>
        <div id="lower-side">
            <p id="message">
                You have already graduated in the university! 
                We hope to see you thrive in your chosen career!
                Best Regards from University of Northern Philippines.
            </p>
            <div class="loader"></div>
        </div>
    </div>
    <script>
        // JavaScript to automatically redirect after 3 seconds
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 5000); // Redirects after 3000 milliseconds (3 seconds)
    </script>
</body>
</html>
