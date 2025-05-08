<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueItemView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }
     /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
CREATE VIEW view_queue_items AS
    SELECT 
        p.id,
        p.code,
        p.name,
        p.selling_price,
        1 as session_count,
        p.current_stock,
        p.is_stock_unlimited,
        0 as is_package,
        '' as products,
        t.description as type,
        c.description as category,
        u.description as uom,
        p.branch_id,
        p.product_type_id,
        p.product_category_id
    FROM products p
    join branches b on b.id = p.branch_id
    join product_types t on t.id = p.product_type_id
    join product_categories c on c.id = p.product_category_id
    join uoms u on u.id = p.uom_id
    where p.is_active = 1 and 
    p.deleted_at is null

    union

    SELECT 
        p.id,
        p.code,
        p.name,
        p.selling_price,
        p.session_count,
        0 as current_stock,
        1 as is_stock_unlimited,
        1 as is_package,
        concat(
            IFNULL((select
            group_concat(
                concat(
                    case when pp.qty is null then '' else concat(format(pp.qty, 0), ' ') end, 
                    p.name, 
                    case when p.is_stock_unlimited = 1 then '' else concat(' (',format(p.current_stock, 0), ')') end
                    ) 
                    SEPARATOR '<br/>') as products
            from package_products pp
            join products p on p.id = pp.product_id
            where pp.package_id = p.id and pp.deleted_at is null), ''),
                    '<br/><br/>',
            format(p.session_count, 0), ' session',(case when p.session_count > 1 then 's' else '' end))  as products,
        t.description as type,
        c.description as category,
        '' as uom,
        p.branch_id,
        p.product_type_id,
        p.product_category_id
    FROM packages p
    join branches b on b.id = p.branch_id
    join product_types t on t.id = p.product_type_id
    join product_categories c on c.id = p.product_category_id
    where p.is_active = 1 and 
    p.deleted_at is null
SQL;
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL

DROP VIEW IF EXISTS `view_queue_items`;
SQL;
    }
}
