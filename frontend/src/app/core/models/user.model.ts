class User {
  private _email = '';

  private _password = '';

  private _isGuest = true;

  get isGuest(): boolean {
    return this._isGuest;
  }

  get email(): string {
    return 'mail@example.com';
  }

  set email(value: string) {
    this._email = value;
  }

  get password(): string {
    return this._password;
  }

  set password(value: string) {
    this._password = value;
  }

  confirm() {
    this._isGuest = false;
  }

  clean() {
    this._isGuest = true;
  }
}

export default User;
