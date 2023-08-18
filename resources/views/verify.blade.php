<x-layout>

    <body>

        <h1> Two Factor Verification </h1>
        <form method="POST" action="{{route('verify')}}">
            @csrf
            <label for="">What is your person type?</label>
            <input type="text" id="person_type" name="person_type"><br><br>
            <input type="submit" value="Verify">
        </form>
    </body>

</x-layout>
