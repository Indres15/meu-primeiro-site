
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public funcion user()
    {
        $this->belonsTo(User::class);
    }
}
