<x-layout>

    <body>

        <h1> Create Two-Factor Authentication </h1>

        <form method="POST" action="/2fa-verification">
            @csrf
            <input type="radio" name="twoFA" value="Dog">Dog <br>
            <input type="radio" name="twoFA" value="Cat">Cat <br>
            <input type="radio" name="twoFA" value="Other">Other:
            <input type="text" name="twoFA-other" size="14">

            <input type="submit" value="Next">
        </form>

    </body>
</x-layout>
