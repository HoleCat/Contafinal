<?php

namespace App\Clase\Modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Sistemacontable extends Model
{
protected $fillable=
['codigo','user_id','MANDANTE','INTERFAZ','CORRELAT','NITEM','BUKRS','BUPLA','NEWBS','NEWUM','NEWBK','FWBAS'
,'MWSKZ','GSBER','AUFNR','ZTERM','VBUND','XREF1','XREF2','XREF3','VALUT','XMWST','ZLSPR','ZFBDT'];
}
