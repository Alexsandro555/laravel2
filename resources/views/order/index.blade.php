@extends('layouts.wacker')
@section('content-item')

    <div class="order">
        <leader-tabs>
            <div class="order-form" slot="tab-1">
                {!! Form::open(['route' => 'order', 'method' => 'post']) !!}
                <p>
                    {!! Form::text('firstname', null, ['class' => 'order-text', 'placeholder' => '*Имя']) !!}
                    @if($errors->has('firstname'))
                        <span class="order-error">{!! $errors->first('firstname') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Имя" name="firstname"/>-->
                </p>
                <p>
                    {!! Form::text('surname', null, ['class' => 'order-text', 'placeholder' => '*Фамилия']) !!}
                    @if($errors->has('surname'))
                        <span class="order-error">{!! $errors->first('surname') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Фамилия" name="surname"/>-->
                </p>
                <p>
                    {!! Form::email('email', null, ['class' => 'order-text', 'placeholder' => '*Email']) !!}
                    @if($errors->has('email'))
                        <span class="order-error">{!! $errors->first('email') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Email" name="email"/>-->
                </p>
                <p>
                    {!! Form::text('patronymiс', null, ['class' => 'order-text', 'placeholder' => '*Отчество']) !!}
                    @if($errors->has('patronymiс'))
                        <span class="order-error">{!! $errors->first('patronymiс') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Отчество" name="patronymiс"/>-->
                </p>
                <p>
                    <masked-input name="tel" mask="\+\8 (111) 111-11-11" placeholder="Телефон" class="order-text"/>
                    @if($errors->has('tel'))
                        <span class="order-error">{!! $errors->first('tel') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Телефон" name="tel"/>-->
                </p>
                <p>
                    {!! Form::text('address', null, ['class' => 'order-text', 'placeholder' => '*Адрес']) !!}
                    @if($errors->has('address'))
                        <span class="order-error">{!! $errors->first('address') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Адрес" name="adress"/>-->
                </p>
                <p>
                    {!! Form::text('city', null, ['class' => 'order-text', 'placeholder' => '*Город']) !!}
                    @if($errors->has('city'))
                        <span class="order-error">{!! $errors->first('city') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Город" name="city"/>-->
                </p>
                <!--<div class="order-select-group">-->
                <label for="region">Регион доставки:</label>
                <div class="order-select">
                    {!! Form::select('region', ['Москва и Московская обл','Санкт-Петербург и Ленинградская обл','Россия'], null, ['placeholder' => 'Выберите район']) !!}
                    @if($errors->has('region'))
                        <span class="order-error">{!! $errors->first('region') !!}</span>
                    @endif
                </div>
                <!--</div>-->

                <p>
                    {!! Form::number('index', null, ['class' => 'order-text', 'placeholder' => '*Индекс']) !!}
                    @if($errors->has('index'))
                        <span class="order-error">{!! $errors->first('index') !!}</span>
                    @endif
                </p>
                <!--<input class="order-text" type="text" placeholder=" *Индекс" name="index"/>-->
                </p>
                <p>
                    {!! Form::textarea('comment', null, ['class' => 'order-textarea', 'placeholder' => '*Комментарий к заказу']) !!}
                    @if($errors->has('comment'))
                        <span class="order-error">{!! $errors->first('comment') !!}</span>
                @endif
                <!--<textarea class="order-textarea" placeholder="Комментарий к заказу" name="comment"></textarea>-->
                </p>
                {{Form::hidden('accept', 0)}}
                {!! Form::checkbox('accept', true, false, ['class' => 'order-checkbox', 'id' => 'checkbox']) !!}
            <!--<input type="checkbox" class="order-checkbox" id="checkbox" name="accept"/>-->
                <label for="checkbox">Согласен на обработку данных</label>
                @if($errors->has('accept'))
                    <span class="order-error">{!! $errors->first('accept') !!}</span>
                @endif
                <p>
                {{Form::hidden('sex', 0)}}
                {!! Form::radio('sex', 'male', false, ['class' => 'order-radio', 'id' => 'radio-1']) !!}
                <!--<input type="radio" class="order-radio" id="radio-1" name="pol"/>-->
                    <label for="radio-1">М</label>
                    <!--<br>
                    <br>-->&nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::radio('sex', 'female', false, ['class' => 'order-radio', 'id' => 'radio-2']) !!}
                <!--<input type="radio" class="order-radio" id="radio-2" name="pol"/>-->
                    <label for="radio-2">Ж</label>
                    @if($errors->has('sex'))
                        <span class="order-error">{!! $errors->first('sex') !!}</span>
                    @endif
                </p>
                <br>
                <p class="order-required order-center">
                    *Поля обязательные для заполнениия
                </p>
                <p class="order-center">
                    <button type="submit" class="sbmt-order">Оформить заказ</button>
                </p>
                {{ Form::close() }}
            </div>
            <div class="order-form" slot="tab-2">
                2
            </div>
        </leader-tabs>
        <?php /*<div>
            <div class="order__tab-contact">Контактная информация</div>
            <div class="order__tab-delivry">Способ доставки</div>
        </div>
        <br>
        <fieldset>
            {!! Form::open(['route' => 'order', 'method' => 'post']) !!}
            <p>
                {!! Form::text('firstname', null, ['class' => 'order-text', 'placeholder' => '*Имя']) !!}
                @if($errors->has('firstname'))
                    <span class="order-error">{!! $errors->first('firstname') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Имя" name="firstname"/>-->
            </p>
            <p>
                {!! Form::text('surname', null, ['class' => 'order-text', 'placeholder' => '*Фамилия']) !!}
                @if($errors->has('surname'))
                    <span class="order-error">{!! $errors->first('surname') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Фамилия" name="surname"/>-->
            </p>
            <p>
                {!! Form::email('email', null, ['class' => 'order-text', 'placeholder' => '*Email']) !!}
                @if($errors->has('email'))
                    <span class="order-error">{!! $errors->first('email') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Email" name="email"/>-->
            </p>
            <p>
                {!! Form::text('patronymiс', null, ['class' => 'order-text', 'placeholder' => '*Отчество']) !!}
                @if($errors->has('patronymiс'))
                    <span class="order-error">{!! $errors->first('patronymiс') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Отчество" name="patronymiс"/>-->
            </p>
            <p>
                <masked-input name="tel" mask="\+\8 (111) 111-11-11" placeholder="Телефон" class="order-text"/>
                @if($errors->has('tel'))
                    <span class="order-error">{!! $errors->first('tel') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Телефон" name="tel"/>-->
            </p>
            <p>
                {!! Form::text('address', null, ['class' => 'order-text', 'placeholder' => '*Адрес']) !!}
                @if($errors->has('address'))
                    <span class="order-error">{!! $errors->first('address') !!}</span>
                 @endif
                <!--<input class="order-text" type="text" placeholder=" *Адрес" name="adress"/>-->
            </p>
            <p>
                {!! Form::text('city', null, ['class' => 'order-text', 'placeholder' => '*Город']) !!}
                @if($errors->has('city'))
                    <span class="order-error">{!! $errors->first('city') !!}</span>
                @endif
                <!--<input class="order-text" type="text" placeholder=" *Город" name="city"/>-->
            </p>
            <!--<div class="order-select-group">-->
                <label for="region">Регион доставки:</label>
                <div class="order-select">
                    {!! Form::select('region', ['Москва и Московская обл','Санкт-Петербург и Ленинградская обл','Россия'], null, ['placeholder' => 'Выберите район']) !!}
                    @if($errors->has('region'))
                        <span class="order-error">{!! $errors->first('region') !!}</span>
                    @endif
                </div>
            <!--</div>-->

            <p>
                {!! Form::number('index', null, ['class' => 'order-text', 'placeholder' => '*Индекс']) !!}
                @if($errors->has('index'))
                    <span class="order-error">{!! $errors->first('index') !!}</span>
                @endif
            </p>
                <!--<input class="order-text" type="text" placeholder=" *Индекс" name="index"/>-->
            </p>
            <p>
                {!! Form::textarea('comment', null, ['class' => 'order-textarea', 'placeholder' => '*Комментарий к заказу']) !!}
                @if($errors->has('comment'))
                    <span class="order-error">{!! $errors->first('comment') !!}</span>
                @endif
                <!--<textarea class="order-textarea" placeholder="Комментарий к заказу" name="comment"></textarea>-->
            </p>
            {{Form::hidden('accept', 0)}}
            {!! Form::checkbox('accept', true, false, ['class' => 'order-checkbox', 'id' => 'checkbox']) !!}
            <!--<input type="checkbox" class="order-checkbox" id="checkbox" name="accept"/>-->
            <label for="checkbox">Согласен на обработку данных</label>
            @if($errors->has('accept'))
                <span class="order-error">{!! $errors->first('accept') !!}</span>
            @endif
            <p>
                {{Form::hidden('sex', 0)}}
                {!! Form::radio('sex', 'male', false, ['class' => 'order-radio', 'id' => 'radio-1']) !!}
                <!--<input type="radio" class="order-radio" id="radio-1" name="pol"/>-->
                <label for="radio-1">М</label>
                <!--<br>
                <br>-->&nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::radio('sex', 'female', false, ['class' => 'order-radio', 'id' => 'radio-2']) !!}
                <!--<input type="radio" class="order-radio" id="radio-2" name="pol"/>-->
                <label for="radio-2">Ж</label>
                @if($errors->has('sex'))
                    <span class="order-error">{!! $errors->first('sex') !!}</span>
                @endif
            </p>
            <br>
            <p class="order-required order-center">
                *Поля обязательные для заполнениия
            </p>
            <p class="order-center">
                <button type="submit" class="sbmt-order">Оформить заказ</button>
            </p>
            {{ Form::close() }}
        </fieldset>*/?>
    </div>
@stop