from aiogram.types import InlineKeyboardMarkup, InlineKeyboardButton

new = InlineKeyboardMarkup(inline_keyboard=[
    [InlineKeyboardButton(text='Погода', callback_data='weather')],
    [InlineKeyboardButton(text='Перевод курса валют', callback_data='convert')],
    [InlineKeyboardButton(text='Игра "Больше-меньше"', callback_data='game')]
])