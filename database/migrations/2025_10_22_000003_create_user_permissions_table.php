<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');

            // Dynamically resolve user model
            $userModel   = Config::get('auth.providers.users.model', \App\Models\User::class);
            $userInstance = new $userModel;

            $userTable   = $userInstance->getTable();
            $userKey     = $userInstance->getKeyName();
            $userKeyType = $userInstance->getKeyType(); // int, string

            // Dynamic user_id column type
            if ($userKeyType === 'string') {
                //for uuid/ulid
                $table->string('user_id');
            } else {
                //for big int auto increasement
                $table->unsignedBigInteger('user_id');
            }

            // FK for dynamic user table + key
            $table->foreign('user_id')
                ->references($userKey)
                ->on($userTable)
                ->onDelete('cascade');

            // Permission FK
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');

            // Permission flags
            $table->boolean('create')->default(false);
            $table->boolean('read')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_permissions');
    }
};
