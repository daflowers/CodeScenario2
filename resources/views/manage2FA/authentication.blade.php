<x-layout>

    <body>

        <h1> Manage Two-Factor Authentication </h1>

        <form method="POST" action="/manage2FA">
            @csrf
            <input type="radio" name="twoFA" {{((!empty($row) && $row['person_type']=="Dog") ? "checked" : "")}} value="Dog" /> Dog <br>
            <input type="radio" name="twoFA" {{((!empty($row) && $row['person_type']=="Cat") ? "checked" : "")}} value="Cat" /> Cat <br>
            <input type="radio" name="twoFA" {{((!empty($row) && !in_array($row['person_type'], ['Dog', 'Cat'])) ? "checked" : "")}} value="Other"> Other:
            <input type="text" name="twoFA-other" size="14" value="{{(!empty($row) && !in_array($row['person_type'], ['Dog', 'Cat'])) ? $row['person_type'] : ""}}">
            </br></br>
            <button type="button" ><a href="{{route('settings')}}">Back</a> </button>
            <input type="submit" name="action" value="Save" />

        </form>
        <a href="{{route('logout')}}">Logout</a>
    </body>

</x-layout>
