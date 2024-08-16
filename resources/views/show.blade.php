<!DOCTYPE html>
<html>
<head>
    <title>View Contact</title>
</head>
<body>
    <h1>View Contact</h1>

    <p>Name: {{ $contact->name }}</p>
    <p>Email: {{ $contact->email }}</p>
    <p>Phone: {{ $contact->phone }}</p>
    <p>Address: {{ $contact->address }}</p>

    <a href="{{ url('/contacts') }}">Back to Contacts</a>
</body>
</html>
