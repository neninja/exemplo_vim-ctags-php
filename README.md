# exemplo_vim-ctags-php

Explicação do uso do [ctags](https://github.com/universal-ctags/ctags) com php

## TL;DR

1. Execute `ctags -R .`
2. Utilize <kbd>CTRL</kbd><kbd>X</kbd><kbd>CTRL</kbd><kbd>O</kbd> para ver sugestões de tags (`:h ft-php-omni`)

## "Tutorial"

1. Abra `index.php`
2. Retire o comentário de alguma das linhas
3. Vá até o final da linha e execute <kbd>CTRL</kbd><kbd>X</kbd><kbd>CTRL</kbd><kbd>O</kbd>
4. Note que, se aparecer alguma sugestão, não é a esperada
5. Execute `ctags -R .` no terminal dentro do projeto
6. Note que foi criado o arquivo `tags`
7. Repita os passos: 1, 2, 3
8. Observe que as sugestões agora estão corretas

## Comandos uteis de tags

- <kbd>CTRL</kbd><kbd>X</kbd><kbd>CTRL</kbd><kbd>O</kbd> sugere tags
- `:ts {word}` ou `g]` lista referencias de `word`
- `<c-]>` vai para definição da tag
    - `<c-]>` não funciona no teclado brasileiro ([issue](https://github.com/vim/vim/issues/1378)), a solução é mapear para `<c-\>`
- `<c-t>` volta antes do pulo da tag

## Sugestões

- Caso o arquivo de tags seja criado no projeto ~~como foi feito no tutorial~~, lembre-se de ignorá-lo com `.gitignore`

## Observações

### Vimrc

Meu `vimrc` para utilização de ctags

```vim
set tags=tags

" Goto definition com o cursor em cima
nnoremap <leader>t :tj <c-r><c-w><CR>

" caso no teclado brasileiro <c-]> não funcione
nnoremap <c-\> <c-]>

" Att ctags
" Necessario instalar ctags ou universal ctags
" :call Ctags()
function! Ctags()
    let s:ctags_command="ctags" . 
                  \ " -R --totals" .
                  \ " --exclude=.git --exclude=.svn" .
                  \ " --exclude=vendor" .
                  \ " --php-kinds=cfvit" .
                  \ " --languages=php"

    " procura se existe um arquivo .ctags a mais
    if filereadable(expand(".ctags"))
        let s:ctags_command.=" --options=.ctags"
    endif

    " seta pasta atual como alvo do ctags
    let s:ctags_command.=" ."

    " executa o comando montado na string
    execute "!".s:ctags_command
endfun
```

- Execução da função fora do vim

```sh
vim -c "call Ctags()" -cq
```
