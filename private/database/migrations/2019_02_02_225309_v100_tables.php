<?php

use App\Helpers\Database;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V100Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset');
        $collation = config('database.connections.mysql.collation');

        //DB::statement("ALTER DATABASE `{$database}` CHARACTER SET {$charset} COLLATE {$collation};");
        $conn = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $conn->exec("ALTER DATABASE `{$database}` CHARACTER SET {$charset} COLLATE {$collation};");
        $conn = null;

        /**
         * Ads
         */
        Schema::create('ads', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 191)->nullable();
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->tinyInteger('type')->unsigned()->nullable();
            $table->text('code')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * articles
         */
        Schema::create('articles', function (Blueprint $table) {
            if (Database::supportInnoDBFullTextIndex() === false) {
                $table->engine = 'MyISAM';
            }
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable()->index('idx_userid');
            $table->unsignedTinyInteger('pay_type')->nullable()->comment('1=PPV, 2=PPA');
            $table->decimal('price', 50, 9)->unsigned()->nullable();
            $table->boolean('paid')->nullable();
            $table->boolean('disable_earnings')->nullable();
            $table->unsignedTinyInteger('status')->nullable()
                ->comment('1=active, 2=Inactive, 3=Pending Review, 4=Update Pending Review');
            $table->string('title', 191)->nullable();
            $table->string('slug', 191)->nullable()->unique('idx_slug');
            $table->text('summary')->nullable();
            $table->longtext('content')->nullable();
            $table->longtext('tmp_content')->nullable();
            $table->bigInteger('featured_image_id')->unsigned()->nullable()->index('idx_image');
            $table->smallInteger('read_time')->unsigned()->nullable()->comment('Number of seconds');
            $table->bigInteger('hits')->unsigned()->default(0);
            $table->longtext('notes')->nullable();
            $table->timestamp('published_at')->nullable()->index('idx_published');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        DB::statement("ALTER TABLE `articles` " .
            "ADD FULLTEXT KEY `idx_title_summary_content` (`title`,`summary`,`content`);");

        /**
         * article_category
         */
        Schema::create('article_category', function (Blueprint $table) {
            $table->bigInteger('article_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->boolean('main')->default(0);
            $table->primary(['article_id', 'category_id']);
        });

        /**
         * article_tag
         */
        Schema::create('article_tag', function (Blueprint $table) {
            $table->bigInteger('article_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->primary(['article_id', 'tag_id']);
        });

        /**
         * bookmarks
         */
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('article_id')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * categories
         */
        Schema::create('categories', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable()->index('idx_parentid');
            $table->string('name', 191)->nullable();
            $table->string('slug', 191)->nullable()->unique('idx_slug');
            $table->boolean('status')->nullable()->index('idx_status');
            $table->text('description')->nullable();
            $table->string('color', 30)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * comments
         */
        Schema::create('comments', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable()->index('idx_userid');
            $table->bigInteger('article_id')->unsigned()->nullable()->index('idx_articleid');
            $table->bigInteger('parent_id')->unsigned()->nullable()->index('idx_parentid');
            $table->text('content')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * files
         */
        Schema::create('files', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable()->index('idx_userid');
            $table->string('name', 191)->nullable();
            $table->string('file', 191)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('size', 191)->nullable()->comment('in bytes');
            $table->string('sha1sum', 40)->nullable();
            $table->text('meta')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * followers
         */
        Schema::create('followers', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('author_id')->unsigned()->nullable()->index('idx_authorid');
            $table->bigInteger('follower_id')->unsigned()->nullable()->index('idx_followerid');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * menus
         */
        Schema::create('menus', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 191)->nullable();
            $table->text('items')->nullable();
        });

        /**
         * options
         */
        Schema::create('options', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 100)->nullable()->unique('idx_name');
            $table->text('value')->nullable();
            $table->boolean('auto')->default(1)->index('idx_auto');
        });

        /**
         * pages
         */
        Schema::create('pages', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->string('title', 191)->nullable();
            $table->string('slug', 191)->nullable()->unique('idx_slug');
            $table->text('content')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * sidebars
         */
        Schema::create('sidebars', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 191)->nullable();
            $table->text('widgets')->nullable();
        });

        /**
         * social_profiles
         */
        Schema::create('social_profiles', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable()->index('idx_userId');
            $table->string('provider', 15)->nullable();
            $table->string('provider_id', 50)->nullable();
            $table->string('nickname', 191)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('avatar', 191)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->unique(['provider', 'provider_id'], 'idx_provider_providerId');
        });

        /**
         * statistics
         */
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('article_id')->unsigned()->nullable()->index('idx_articleid');
            $table->bigInteger('user_id')->unsigned()->nullable()->index('idx_userid');
            $table->bigInteger('referral_id')->unsigned()->nullable()->index('idx_referralid');
            $table->string('ip', 45)->nullable()->index('idx_ip');
            $table->string('country', 2)->nullable();
            $table->decimal('author_earn', 50, 9)->unsigned()->nullable();
            $table->decimal('referral_earn', 50, 9)->unsigned()->nullable();
            $table->tinyInteger('reason')->unsigned()->nullable()->index('idx_reason')
                ->comment('1- Earn, 2- Not reached article read time, 3- reCAPTCHA V3 is incorrect, ' .
                    '4- reCAPTCHA V3 low score, 5- User disabled earnings, 6- Earnings disabled, 7- Invalid Country, ' .
                    '8- Disabled cookie, 9- IP changed, 10- Adblock, 11- Proxy, 12- Not unique');
            $table->string('referer_domain', 191)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index(['created_at', 'user_id'], 'idx_createdat_userid');
        });

        /**
         * tags
         */
        Schema::create('tags', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 191)->nullable();
            $table->string('slug', 191)->nullable()->unique('idx_slug');
            $table->boolean('status')->nullable()->index('idx_status');
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * users
         */
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 191)->nullable();
            $table->string('username', 191)->nullable()->unique('idx_username');
            $table->string('email', 191)->nullable()->unique('idx_email');
            $table->string('password', 191);
            $table->tinyInteger('status')->unsigned()->nullable()->default(2)
                ->comment('1=active, 2=pending, 3=inactive');
            $table->string('role', 10)->nullable();
            $table->text('description')->nullable();
            $table->text('social_networks')->nullable();
            $table->boolean('disable_earnings')->default(0);
            $table->decimal('author_earnings', 50, 9)->unsigned()->nullable();
            $table->decimal('referral_earnings', 50, 9)->unsigned()->nullable();
            $table->bigInteger('referred_by')->unsigned()->nullable();
            $table->string('withdrawal_method', 191)->nullable();
            $table->text('withdrawal_account')->nullable();
            $table->string('tmp_email', 191)->nullable();
            $table->string('activation_key', 40)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('login_ip', 45)->nullable();
            $table->string('register_ip', 45)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * withdraws
         */
        Schema::create('withdraws', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->tinyInteger('status')->unsigned()->nullable()
                ->comment('1=Approved, 2=Pending, 3=Complete, 4=Cancelled');
            $table->decimal('author_earnings', 50, 9)->unsigned()->nullable();
            $table->decimal('referral_earnings', 50, 9)->unsigned()->nullable();
            $table->decimal('amount', 50, 9)->unsigned()->nullable();
            $table->string('method', 191)->nullable();
            $table->text('account')->nullable();
            $table->text('data')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index(['status', 'user_id'], 'idx_status_userid');
            $table->index(['created_at', 'user_id'], 'idx_created_userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ads');
        Schema::drop('article_category');
        Schema::drop('article_tag');
        Schema::drop('articles');
        Schema::drop('bookmarks');
        Schema::drop('categories');
        Schema::drop('comments');
        Schema::drop('files');
        Schema::drop('followers');
        Schema::drop('menus');
        Schema::drop('options');
        Schema::drop('pages');
        Schema::drop('sidebars');
        Schema::drop('social_profiles');
        Schema::drop('statistics');
        Schema::drop('tags');
        Schema::drop('users');
        Schema::drop('withdraws');
    }
}
