<!-- view/emails/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Hoş geldin!</title>
</head>
<body>
    <h1>Merhaba, {{ $user->name ?? 'Değerli Kullanıcı' }}!</h1> 
    <p>Laravel uygulamamıza hoş geldiniz. E-posta adresiniz: {{ $user->email ?? 'Email adresi bulunamadı' }}</p> 
</body>
</html>
