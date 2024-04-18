    <!-- View for creating task -->
    <div class="container">
        <!-- {{ __('lang.naziv_stranice') }} gets the correct lable from resources/lang based on the locale-->
        <h1>{{ __('lang.naziv_stranice') }}</h1>
        <form method="POST" action="{{ route('language.change',  app()->getLocale() == 'hr' ? 'en' : 'hr')}}">
            @csrf
            <a href="../../language/{{ app()->getLocale() == 'hr' ? 'en' : 'hr' }}">{{ app()->getLocale() == 'hr' ? 'Engleski' : 'Hrvatski' }}</a>
        </form>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div class="form-group">
                <label for="naziv_rada">{{ __('lang.naziv_rada') }}</label>
                <input type="text" class="form-control" id="naziv_rada" name="naziv_rada" required>
            </div>

            <div class="form-group">
                <label for="naziv_rada_eng">{{ __('lang.naziv_rada_eng') }}</label>
                <input type="text" class="form-control" id="naziv_rada_eng" name="naziv_rada_eng" required>
            </div>

            <div class="form-group">
                <label for="zadatak_rada">{{ __('lang.zadatak_rada') }}</label>
                <textarea class="form-control" id="zadatak_rada" name="zadatak_rada" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="tip_studija">{{ __('lang.tip_studija') }}</label>
                <select class="form-control" id="tip_studija" name="tip_studija" required>
                    <option value="stručni">Stručni</option>
                    <option value="preddiplomski">Preddiplomski</option>
                    <option value="diplomski">Diplomski</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
