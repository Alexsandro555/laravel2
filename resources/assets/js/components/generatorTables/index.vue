<template>
    <div>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Основные параметры</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div :class="{'form-group': true, 'has-error': errors.has('table_name')}">
                            <label>Название таблицы</label>
                            <input name="table_name" v-validate="'required'" data-vv-delay="1000" v-model="createTable.tableName" :class="{'form-control': true}" type="text" placeholder="">
                            <span v-show="errors.has('table_name')" class="help-block">{{ errors.first('table_name')}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div :class="{'form-group': true, 'has-error': errors.has('visual_table_name')}">
                            <label>Визуальное представление</label>
                            <input name="visual_table_name" v-validate="'required'" data-vv-delay="1000" v-model="createTable.tableVisualName" :class="{'form-control': true}" type="text" placeholder="">
                            <span v-show="errors.has('visual_table_name')" class="help-block">{{ errors.first('visual_table_name')}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Автозаполняемое поле</label>
                            <my-autocomplete v-on:autocomplate-update="AutocompleteUpdateHandler"></my-autocomplete>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label class="control-label">Доступные действия:</label>
                        <label><toggle-button :value="false" :sync="true" :labels="true" @change="onChangeEventHandler" color="#82C7EB"/></label>
                        <label><input type="checkbox" v-model="createTable.create"> Создать </label> |
                        <label><input type="checkbox" v-model="createTable.edit"> Редактировать </label> |
                        <label><input type="checkbox" v-model="createTable.show"> Отобразить </label> |
                        <label><input type="checkbox" v-model="createTable.delete"> Удалить </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Добалвление полей</h3>
            </div>
            <div class="panel-body">
                <em><b>Примечание:</b>"вам" <b>не</b> нужно добавлять поля <b>ID</b> и <b>timestamp</b> они добавятся автоматически</em>
                <div class="row">
                    <div class="col-xs-12 form-group hidden" id="alert-saving">
                        <div class="alert alaert-danger">
                            <p>
                                Нажмите сохранить таблицу для создания/редактирования полей.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th data-toggle="tooltip" data-placement="top" title width="5" data-original-title="Переупрядочить поля"></th>
                                    <th data-toggle="tooltip" data-placement="top" data-original-title="Тип поля в форме">Тип поля</th>
                                    <th data-toggle="tooltip" data-placement="top" data-original-title="Имя поля в форме и в базе данных">Столбец БД</th>
                                    <th data-toggle="tooltip" data-placement="top" data-original-title="Метка поля в форме и на страницце отображения">Визуальное представление</th>
                                    <th>Список</th>
                                    <th>Создать</th>
                                    <th>Отображать</th>
                                    <th>Обязательное</th>
                                    <th data-toggle="tooltip" data-placement="top" title width="30" class="text-center" data-original-title="Редактировать">Редактировать</th>
                                    <th data-toggle="tooltip" data-placement="top" title width="30" class="text-center" data-original-title="Удалить поле из отображения">Удалить</th>
                                </tr>
                            </thead>
                            <tbody  class="sortable ui-sortable">
                                <!--<tr v-if="fields.length == 0" id="no-fields">
                                    <td colspan="5000" class="text-center">
                                        Вы не имеете полей в таблице. <a href="#" class="add-field">Добавить новое поле</a>
                                    </td>
                                </tr>-->
                                <tr v-for="field of createTable.fields">
                                    <td></td>
                                    <td>{{ field.type }}</td>
                                    <td>{{ field.name }}</td>
                                    <td>{{ field.visual }}</td>
                                    <td>{{ field.show_list }}</td>
                                    <td>{{ field.create }}</td>
                                    <td>{{ field.show }}</td>
                                    <td>{{ field.required }}</td>
                                    <td>{{ field.edit }}</td>
                                    <td>{{ field.delete}}</td>
                                </tr>
                                <tr v-if="flagAddFields || fields.length>0">
                                    <td></td>
                                    <td width="295px">
                                        <div :class="{'form-group': true, 'has-error': errors.has('type')}">
                                            <input name="type" v-validate="'required'" max-width="293"  :class="{'form-control': true}"  v-model="createTable.newField.type" type="text" placeholder="">
                                            <span v-show="errors.has('type')" class="help-block">{{ errors.first('type')}}</span>
                                        </div>
                                    </td>
                                    <td width="295px">
                                        <div :class="{'form-group': true, 'has-error': errors.has('name')}">
                                            <input name="name" v-validate="'required'"  :class="{'form-control': true}" v-model="createTable.newField.name" type="text" placeholder="">
                                            <span v-show="errors.has('name')" class="help-block">{{ errors.first('name')}}</span>
                                        </div>
                                    </td>
                                    <td width="295px">
                                        <div :class="{'form-group': true, 'has-error': errors.has('visual')}">
                                            <input name="visual" v-validate="'required'"  :class="{'form-control': true}" class="form-control" v-model="createTable.newField.visual" type="text" placeholder="">
                                            <span v-show="errors.has('visual')" class="help-block">{{ errors.first('visual')}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.show_list" type="checkbox">
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.create" type="checkbox">
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.show" type="checkbox">
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.required" type="checkbox">
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.edit" type="checkbox">
                                    </td>
                                    <td>
                                        <input v-model="createTable.newField.delete" type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="11">
                                        <button class="btn btn-danger add-field" v-on:click="addField" style="width:100%"><i class="fa fa-plus"></i> Добавить поле</button>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <button class="btn btn-primary" v-on:click="Save">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data()
        {
          return {
                    // флаг: true - массив fields имеет значения
                    flagAddFields: true,
                    // для сброса в изначальное состояние
                    defaultfield: {
                        type: '',
                        name: '',
                        visual: '',
                        show_list: false,
                        create: false,
                        show: false,
                        required: false,
                        edit: false,
                        delete: false
                    },
                    createTable:
                    {
                        tableName: '',
                        tableVisualName: '',
                        create: false,
                        edit: false,
                        show: false,
                        delete: false,
                        fields: [],
                        // текущие значения
                        newField: {
                            type: '',
                            name: '',
                            visual: '',
                            show_list: false,
                            create: false,
                            show: false,
                            required: false,
                            edit: false,
                            delete: false
                        }
                    }
           }
        },
        methods: {
            addField: function () {
                this.$validator.validateAll().then(() => {
                    this.createTable.fields.push(this.createTable.newField);
                    this.createTable.newField = null;
                    this.createTable.newField = _.clone(this.defaultfield, true);
                }).catch(() => {
                });
            },
            Save: function () {
                this.$validator.validateAll().then(() => {
                    this.axios.post('/admin/page/createTable', {
                        createTable: this.createTable
                    }).then(function (response)
                    {
                        console.log(response);
                    }).catch(function (error)
                    {
                        console.log(error);
                    });
                }).catch(() => {
                });
            },
            onChangeEventHandler: function ($event) {
                console.log($event);
            },
            AutocompleteUpdateHandler: function($value)
            {
                console.log($value);
            }
        }
    }
</script>