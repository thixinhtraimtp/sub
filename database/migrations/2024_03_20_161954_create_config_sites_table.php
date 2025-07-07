<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('config_sites', function (Blueprint $table) {
            $table->id();
            $table->string('name_site')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('author')->nullable();
            $table->string('thumbnail')->nullable();

            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->string('telegram')->nullable();
            $table->enum('maintenance', ['on', 'off'])->default('off');

            /*  */
            $table->longText('collaborator')->nullable()->comment('Mức nạp cộng tác viên');
            $table->longText('agency')->nullable()->comment('Mức nạp đại lý');
            $table->longText('distributor')->nullable()->comment('Mức nạp nhà phân phối');

            // recharge
            $table->string('start_promotion')->nullable(); // bắt đầu khuyến mãi
            $table->string('end_promotion')->nullable(); // kết thúc khuyến mãi
            $table->string('percent_promotion')->nullable(); // khuyến mãi
            $table->string('transfer_code')->nullable(); // mã chuyển tiền

            // teleragm bot notify
            $table->string('telegram_chat_id')->nullable();
            $table->string('telegram_bot_token')->nullable();
            $table->string('telegram_bot_username')->nullable();

            // telegram bot webhook
            $table->string('telegram_bot_chat_id')->nullable();
            $table->string('telegram_bot_chat_token')->nullable();
            $table->longText('telegram_bot_chat_username')->nullable();


            // notice
            $table->longText('notice')->nullable();

            // script
            $table->longText('script_head')->nullable();
            $table->longText('script_body')->nullable();
            $table->longText('script_footer')->nullable();

            // auth admin site
            $table->string('admin_username')->nullable();
            $table->longText('site_token')->nullable();
            $table->enum('status', ['active', 'pending', 'inactive'])->nullable();

            $table->timestamps();
            $table->string('domain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_sites');
    }
};
