
<x-alert/>
@csrf()
<input type="text" name="name" placeholder="Nome" value="{{ $user->name ?? old('name')}}">
<input type="email" name="email" placeholder="email" value="{{$user->email ?? old('email')}}">
<input type="password" name="password" placeholder="senha">
<button type="submit">Enviar</button>