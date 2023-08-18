<x-layout>

    <body>


    <h1> Create New Account </h1>

    <form method="POST" action="/register">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Next">
    </form>

    </body>

</x-layout>
