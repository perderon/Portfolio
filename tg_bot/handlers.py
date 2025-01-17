import requests
import random
from config import open_weather_token, API_KEY, VALID_CURRENCIES
from aiogram import F, Router
from aiogram.filters import CommandStart
from aiogram.types import Message, CallbackQuery
from aiogram.fsm.state import StatesGroup, State
from aiogram.fsm.context import FSMContext
import keyboards as kb

router = Router()

class WeatherStates(StatesGroup):
    waiting_for_city = State()

class CurrencyConverter(StatesGroup):
    base_currency = State()
    target_currency = State()
    amount = State()

class GuessNumberStates(StatesGroup):
    waiting_for_number = State()

@router.message(CommandStart())
async def cmd_start(message: Message):
    await message.reply(f'Привет, {message.from_user.full_name}, выберите нужный сервис.', reply_markup=kb.new)

@router.callback_query(F.data == 'weather')
async def weather_callback(callback_query: CallbackQuery, state: FSMContext):
    await callback_query.answer('Вы выбрали "погода".')
    await callback_query.message.answer("Введите название города, чтобы узнать погоду:")
    await state.set_state(WeatherStates.waiting_for_city)

@router.callback_query(F.data == 'convert')
async def convert_callback(callback_query: CallbackQuery, state: FSMContext):
    await callback_query.answer('Вы выбрали "Конвертер валют".')
    await callback_query.message.answer("Введите базовую валюту (например, USD):")
    await state.set_state(CurrencyConverter.base_currency)

@router.callback_query(F.data == 'game')
async def game_callback(callback_query: CallbackQuery, state: FSMContext):
    await callback_query.answer('Вы выбрали "Игра больше-меньше"')
    await callback_query.message.answer("Я загадал число от 1 до 100. Попробуй угадать!")
    await state.set_state(GuessNumberStates.waiting_for_number)

@router.message(WeatherStates.waiting_for_city)
async def get_weather(message: Message, state: FSMContext):
    r = requests.get(f'https://api.openweathermap.org/data/2.5/weather?q={message.text}&appid={open_weather_token}&units=metric')
    data = r.json()

    if r.status_code == 404:
        await message.reply("Извините, указанный вами город не найден. Пожалуйста, уточните название города.")
        return

    city = data['name']
    cur_weather = data['main']['temp']
    humidity = data['main']['humidity']
    pressure = data['main']['pressure']

    await message.reply(f'Погода в городе: {city}\nТемпература: {cur_weather} C\n'
                        f'Влажность: {humidity}%\nДавление: {pressure} мм.рт.ст.')
    await message.answer(f'Спасибо за использование. Если нужно что то еще, то выберите с помощью меню ниже.', reply_markup=kb.new)
    await state.clear()

@router.message(GuessNumberStates.waiting_for_number)
async def guess_number(message: Message, state: FSMContext):
    try:
        user_guess = int(message.text)
        if not 1 <= user_guess <= 100:
            raise ValueError
    except ValueError:
        await message.reply("Пожалуйста, введите целое число от 1 до 100.")
        return

    global random_number  

    if 'random_number' not in globals():
        random_number = random.randint(1, 100)  

    if user_guess < random_number:
        await message.reply("Моё число больше.")
    elif user_guess > random_number:
        await message.reply("Моё число меньше.")
    else:
        await message.reply("Поздравляю! Ты угадал число!")
        random_number = random.randint(1, 100)  
        await message.answer(f'Спасибо за использование. Если нужно что-то еще, то выберите с помощью меню ниже.', reply_markup=kb.new)
        await state.clear()


@router.message(CurrencyConverter.base_currency)
async def process_base_currency(message: Message, state: FSMContext):
    base_currency = message.text.upper()
    if base_currency not in [code for code, name in VALID_CURRENCIES]:
        await message.answer("Некорректный код валюты. Пожалуйста, введите правильный код валюты (например, USD).")
        return
    await state.update_data(base_currency=base_currency)
    await message.answer("Введите целевую валюту (например, EUR):")
    await state.set_state(CurrencyConverter.target_currency)

@router.message(CurrencyConverter.target_currency)
async def process_target_currency(message: Message, state: FSMContext):
    target_currency = message.text.upper()
    if target_currency not in [code for code, name in VALID_CURRENCIES]:
        await message.answer("Некорректный код валюты. Пожалуйста, введите правильный код валюты (например, EUR).")
        return
    await state.update_data(target_currency=target_currency)
    await message.answer("Введите сумму для конвертации:")
    await state.set_state(CurrencyConverter.amount)

@router.message(CurrencyConverter.amount)
async def process_amount(message: Message, state: FSMContext):
    try:
        amount = float(message.text)
    except ValueError:
        await message.answer("Пожалуйста, введите корректное число.")
        return

    user_data = await state.get_data()
    base_currency = user_data['base_currency']
    target_currency = user_data['target_currency']
    amount = float(message.text)

    url = f"https://v6.exchangerate-api.com/v6/{API_KEY}/latest/{base_currency}"
    response = requests.get(url)
    data = response.json()

    if response.status_code == 200 and target_currency in data['conversion_rates']:
        conversion_rate = data['conversion_rates'][target_currency]
        converted_amount = amount * conversion_rate
        await message.answer(f"{amount} {base_currency} = {converted_amount:.2f} {target_currency}")
    else:
        await message.answer("Ошибка: не удалось получить курс валют. Проверьте правильность введенных данных.")
    await message.answer(f'Спасибо за использование. Если нужно что то еще, то выберите с помощью меню ниже.', reply_markup=kb.new)
    await state.clear()