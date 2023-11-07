<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Comentario extends Model {
        use HasFactory;
        
        // Asignar qué nombre de tabla tiene en la BD.
        protected $table = 'comentarios'; 

        // Asignando los campos 'llenables' de la tabla. 
        protected $fillable = [
            'contenido',
            'usuario_id',
            'producto_id',
        ];

        // Relación foránea.
        public function usuario() {
            return $this->belongsTo(Usuario::class, 'usuario_id');
        }

        public function producto() {
            return $this->belongsTo(Product::class, 'producto_id');
        }
    }