<x-layout>

    <body>
        <h1> Welcome to the Coding Scenario </h1>
        <form method="POST" action="{{route('login')}}">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>

        <br>
        <a href="/register">Create Account</a>

    </body>

</x-layout>
