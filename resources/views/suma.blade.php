<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Sumar</title>
</head>
<body>
    <form action="/suma" method="post">
        @csrf
        <label for="num1">Ingrese el primer número:</label>
        <input type="number" id="num1" name="num1" required>

        <label for="num2">Ingrese el segundo número:</label>
        <input type="number" id="num2" name="num2" required>

        <input type="submit">
    </form>

    @if (isset($resultado))
        <h2>El resultado es: {{ $resultado }}</h2>
    @endif
</body>
</html>
