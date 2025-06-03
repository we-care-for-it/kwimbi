<?PHP

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_statuses', function (Blueprint $table) {
            $table->dropForeign(['company_id']);

            $table->dropColumn('company_id');
            $table->integer('sort')->default(0)->after('name'); // Adjust 'after' as needed
        });
    }

    public function down(): void
    {
        Schema::table('project_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable(); // Add back if needed
            $table->dropColumn('sort');
        });
    }
};
