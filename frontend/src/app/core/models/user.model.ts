class User {
  private _email = '';

  private _password = '';

  get isGuest(): boolean {
    return true;
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
}

export default User;
