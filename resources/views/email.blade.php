<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.50.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <title>Email</title>
</head>
<body>
    <div class="container mx-auto p-4 h-auto">
        <div class="text-center text-3xl font-bold">
            INVITATION POUR {{ $name }} POUR REJOINDRE LE MINI CRM
        </div>
        <p class="mt-4 text-xl text-center">
            Veuillez accepter l'invitation en cliquant sur le lien ci dessous ou en le copiant et le collant sur votre navigateur
            <div class="my-4 border-2 border-black bg-base-200 rounded-xl p-6  text-center text-lg w-96 mx-auto">
                lien : <b> <a href="{{ env("APP_URL") }}/invitation?id={{ $token }}" class="text-blue-500"> {{ env("APP_URL") }}/invitation?id={{ $token }} </a> </b> <br>
            </div>
        </p>
    </div>
</body>
</html>
