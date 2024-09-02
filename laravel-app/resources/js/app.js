import $ from 'jquery';
import './bootstrap';
import kuromoji from "kuromoji";

const LABEL_BTN_REMOVE_FROM_DICT = 'Remove from My Vocabulary';
const LABEL_BTN_ADD_TO_DICT = 'Add to My Vocabulary';

$('.btn-analyze').on('click', function() {
    $('.loading-overlay').show().css('display', 'flex');

    let inputText = $('textarea').val();

    kuromoji.builder({ dicPath: null }).build(function(err, tokenizer) {

        if (err) {
            console.log(err);
        } else {
            let tokenizedText = tokenizer.tokenize(inputText);
            let words = [];
            $.each(tokenizedText, function(key, value) {
                if (value.basic_form != '*' && value.basic_form != '。') {
                    words.push(value.basic_form);
                }
            });

            $.ajax({
                type: 'GET',
                url: '/api/analyze',
                data: {
                    words: words
                },
                success: (response) => {
                    let output = '';
                    $.each(response.data, function (key, value) {

                        let dictBtn = `<i class="add-to-dict">${LABEL_BTN_ADD_TO_DICT}</i>`;

                        if (value['en_translations'] == '-') {
                            dictBtn = '';
                        }

                        if (value['is_in_db']) {
                            dictBtn = `<i class="remove-from-dict">${LABEL_BTN_REMOVE_FROM_DICT}</i>`;
                        }

                        output += `<li class="li-output"><p>${key}: <b>${value['en_translations']}</b></p>${dictBtn}</li>`;
                    });

                    $('.div-output').html(output).css('color', 'black');
                },
                error: (err) => {
                    if (err.status == 422) {
                        $('.div-output').html(`<p>${JSON.parse(err.responseText).error.words[0]}</p>`).css('color', 'red');
                    } else {
                        $('.div-output').html('Sorry! An error occurred. Please contact the administrator.').css('color', 'red');
                    }
                },
                complete: () => {
                    $('.loading-overlay').hide();
                }
            });
        }
    });
});

$('.div-output').on('click', '.add-to-dict', function() {
    $('.loading-overlay').show().css('display', 'flex');

    let inputText = $(this).siblings('p').text();

    $.ajax({
        type: 'POST',
        url: '/api/dictionary',
        data: {
            word: inputText
        },
        success: (response) => {
            $(this).text(LABEL_BTN_REMOVE_FROM_DICT).css('background-color', '#dc3545').addClass('remove-from-dict').removeClass('add-to-dict');
            hideOrShowQuizBtn(response.is_quiz_enable);
        },
        error: (err) => {
            $('.div-output').html('Sorry! An error occurred. Please contact the administrator.').css('color', 'red');
        },
        complete: () => {
            $('.loading-overlay').hide();
        }
    });
});

$('.div-output').on('click', '.remove-from-dict', function() {
    $('.loading-overlay').show().css('display', 'flex');

    let inputText = $(this).siblings('p').text();

    $.ajax({
        type: 'DELETE',
        url: '/api/dictionary',
        data: {
            word: inputText
        },
        success: (response) => {
            $(this).text(LABEL_BTN_ADD_TO_DICT).css('background-color', '#007bff').removeClass('remove-from-dict').addClass('add-to-dict');
            hideOrShowQuizBtn(response.is_quiz_enable);
        },
        error: (err) => {
            $('.div-output').html('Sorry! An error occurred. Please contact the administrator.').css('color', 'red');
        },
        complete: () => {
            $('.loading-overlay').hide();
        }
    });
});

$('.btn-submit').on('click', function() {
    let answer = $('.answer').val();
    let selectedAnswer = $('input[name=select-answer]:checked').val();

    if (answer == selectedAnswer) {
        $('.div-output').html('Correct!').css('color', 'green');
    } else {
        $('.div-output').html('Wrong!').css('color', 'red');
    }
});

$('.btn-refresh').on('click', function() {
    location.reload();
});

function hideOrShowQuizBtn(isQuizEnable) {
    if (isQuizEnable) {
        $('.btn-quiz').show();
    } else {
        $('.btn-quiz').hide();
    }
}