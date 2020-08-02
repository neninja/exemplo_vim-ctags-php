# exemplo_vim-ctags-php

Explicação do uso do [ctags](https://github.com/universal-ctags/ctags) com php

## TL;DR

1. Execute `ctags -R .`
2. Utilize `<c-x><c-o>` para ver sugestões de tags

## "Tutorial"

1. Abra `index.php`
2. Retire o comentário de alguma das linhas
3. Vá até o final da linha e execute `<c-x><c-o>`
4. Note que, se aparecer alguma sugestão, não é a esperada
5. Execute `ctags -R .` no terminal dentro do projeto
6. Note que foi criado o arquivo `tags`
7. Repita os passos: 1, 2, 3
8. Observe que as sugestões agora estão corretas

## Comandos uteis de tags

- `<c-x><c-o>` sugere tags
- `:ts {word}` ou `g]` lista referencias de `word`
- `<c-]>` vai para definição da tag
    - `<c-]>` não funciona no teclado brasileiro ([issue](https://github.com/vim/vim/issues/1378)), a solução é mapear para `<c-\>`
- `<c-t>` volta antes do pulo da tag

## Sugestões

- Caso o arquivo de tags seja criado no projeto, lembre-se de ignorá-lo com `.gitignore`

## Observações

### Vimrc

Meu `vimrc` para utilização de ctags

```vim
set tags=tags

" Goto definition
nnoremap <leader>t :tj <c-r><c-w><CR>

" teclado brasileiro <c-]> não funciona
nnoremap <c-\> <c-]>

" Att ctags
" Necessario instalar ctags ou universal ctags
" :call Ctags()
function! Ctags()
    let s:ctags_command="ctags" . 
                  \ " -R --totals" .
                  \ " --exclude=.git --exclude=.svn" .
                  \ " --exclude=vendor" .
                  \ " --exclude=node_modules --exclude=dist --exclude=build --exclude=ios --exclude=android" .
                  \ " --exclude=_site" .
                  \ " --languages=php,javascript"

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
