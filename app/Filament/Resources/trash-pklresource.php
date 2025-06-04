Select::make('siswa_id')
->label('Siswa')
->relationship('siswa', 'nama')
->options(function () {
$usedId = PKL::pluck('siswa_id')->toArray();
return Siswa::whereNotIn('id', $usedId)->pluck('nama', 'id');
})
->live()
// untuk memunculkan nis di form
->afterStateUpdated(fn($state, Set $set)
=> $set('nis', Siswa::find($state)->nis))
// untuk memunculkan nis di edit atau view
->afterStateHydrated(function ($state, Set $set) {
$siswa = Siswa::find($state);
if ($siswa) {
$set('nis', $siswa->nis);
}
})
->required(),


// mengambil data user berdasarkan email

Hidden::make('siswa_id')
->default(fn() => Siswa::where('email', Auth::user()->email)->first())
->required(),
// Hidden::make('email')
// ->default(fn() => Siswa::where('email', auth()->id())->value('email'))
// ->afterStateHydrated(function ($state, Set $set) {
// $siswa = Siswa::find($state);
// if ($siswa) {
// $set('siswa_nama', $siswa->nama);
// }
// })
// ->required()
// ->live(),
// Hidden::make('siswa_id')
// ->default(fn() => Siswa::where('user_id', auth()->id())->value('id'))
// ->afterStateHydrated(function ($state, Set $set) {
// $siswa = Siswa::find($state);
// if ($siswa) {
// $set('siswa_nama', $siswa->nama);
// }
// })
// ->required(),

TextInput::make('siswa_nama')
->label('Siswa')
->default(fn() =>
// siswa yang login
(auth()->user()->name))
// dd(auth()->user()->name))

->live()
// untuk memunculkan nis di form
->afterStateUpdated(fn($state, Set $set)
=> $set('nis', Siswa::find($state)->nis))
// untuk memunculkan nis di edit atau view
->afterStateHydrated(function ($state, Set $set) {
$siswa = Siswa::find($state);
if ($siswa) {
$set('nis', $siswa->nis);
}
})

->disabled()
->dehydrated(false),


TextInput::make('nis')
->label('NIS')
->disabled(true)
// mengambil nis siswa berdasarkan akun yang login
->default(fn() => (auth()->user()->id))
// agar tidak tersimpan di database
->dehydrated(false),


Select::make('siswa_id')
->label('Siswa')
->relationship('siswa', 'nama')
->options(function () {
$usedId = PKL::pluck('siswa_id')->toArray();
return Siswa::whereNotIn('id', $usedId)->pluck('nama', 'id');
})
->live()
// untuk memunculkan nis di form
->afterStateUpdated(fn($state, Set $set)
=> $set('nis', Siswa::find($state)->nis))
// untuk memunculkan nis di edit atau view
->afterStateHydrated(function ($state, Set $set) {
$siswa = Siswa::find($state);
if ($siswa) {
$set('nis', $siswa->nis);
}
})
->required(),

TextInput::make('nis')
->label('NIS')
->disabled(true)
// agar tidak tersimpan di database
->dehydrated(false),