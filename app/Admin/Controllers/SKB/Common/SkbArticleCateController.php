<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbArticleCateModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbArticleCateController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('水可邦文章分类');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新增');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(SkbArticleCateModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('分类名称')->editable();
            $grid->pid('上级分类')->display(function ($pid) {
                return $pid > 0
                ? SkbArticleCateModel::find($pid)->title
                : '顶级分类';
            })->label('primary');
            $grid->order('分类排序')->editable()->sortable();

            $grid->created_at('创建时间');

            $grid->filter(function ($filter) {

                $filter->disableIdFilter();
                $filter->like('title', '分类名称');

            });

            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbArticleCateModel::class, function (Form $form) {

            $form->select('pid', '上级分类')
                 ->options(SkbArticleCateModel::all()
                 ->pluck('title', 'id'))->help('不填代表顶级分类');
            $form->text('title', '分类名称');
            $form->number('order', '排序')->default(99);
            $form->textarea('remark', '备注');

        });
    }
}
