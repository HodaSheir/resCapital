<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .thumbnail {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
        }

        #imagePreview img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <form id="userForm" enctype="multipart/form-data" action="process-file.php" method="post">
            <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}"> <!-- CSRF token -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="userImage">User Image:</label>
                <input type="file" id="userImage" name="user_image" accept="image/*" required>
                <div class="thumbnail" id="imagePreview"></div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userImage').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').html(`<img src="${e.target.result}" alt="User Image">`);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

</body>

</html>