<form action="/user/remake/" method="post">
  <p>
    <label for="user-name">Имя:</label>
    <input id="user-name" type="text" name="name" value="{{ user.getUserName() }}">
  </p>
  <p>
    <label for="user-lastname">Фамилия:</label>
    <input id="user-lastname" type="text" name="lastname" value="{{ user.getUserLastName() }}">
  </p>  
  <p>
    <label for="user-birthday">День рождения:</label>
    <input id="user-birthday" type="text" name="birthday" placeholder="ДД-ММ-ГГГГ" value="{{ user.getUserDataAsArray()['userbirthday'] }}">
  </p>
  <p><input type="submit" value="Сохранить"></p>
</form>