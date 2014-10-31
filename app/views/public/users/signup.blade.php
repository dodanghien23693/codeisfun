
<div class="cell cell--xs well well--l">
    <div class="mbm mbl--m tac">
        <h1>Create Free Account</h1>
    </div>
    <div class="form form--session" id="sign-up-form">
        {{ Form::open(array('url'=>'users/sign) }}
            <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="NTaWFodXBWm5EuvWiOeV37uBsWq9j466B46xSbHf5Ls="></div>
            <fieldset class="form-field">
                <!-- TODO: replace class with the class you want -->
                <label class="form-label" data-required="true" for="user_email">Your email address</label><input class="form-input" id="registration_email" name="user[email]" size="30" type="email" value="" style="cursor: pointer; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">


                <div class="js-suggest is-hidden">
                    <p class="mbf mts tsm">Did you mean <a href="#" class="js-suggest-email"><span class="js-suggest-address">asf</span>@<span class="js-suggest-domain">gmail.com</span></a>?</p>
                </div>
            </fieldset>
            <fieldset class="form-field">
                <label class="form-label" for="user_username">Choose a username</label><input class="form-input" id="registration_username" name="user[username]" size="30" type="text">


            </fieldset>
            <fieldset class="form-field">
                <label class="form-label" data-required="true" for="user_password">Choose a password</label><input class="form-input mbxs js-showPassword-input" id="registration_password" name="user[password]" size="30" type="password" style="cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACIUlEQVQ4EX2TOYhTURSG87IMihDsjGghBhFBmHFDHLWwSqcikk4RRKJgk0KL7C8bMpWpZtIqNkEUl1ZCgs0wOo0SxiLMDApWlgOPrH7/5b2QkYwX7jvn/uc//zl3edZ4PPbNGvF4fC4ajR5VrNvt/mo0Gr1ZPOtfgWw2e9Lv9+chX7cs64CS4Oxg3o9GI7tUKv0Q5o1dAiTfCgQCLwnOkfQOu+oSLyJ2A783HA7vIPLGxX0TgVwud4HKn0nc7Pf7N6vV6oZHkkX8FPG3uMfgXC0Wi2vCg/poUKGGcagQI3k7k8mcp5slcGswGDwpl8tfwGJg3xB6Dvey8vz6oH4C3iXcFYjbwiDeo1KafafkC3NjK7iL5ESFGQEUF7Sg+ifZdDp9GnMF/KGmfBdT2HCwZ7TwtrBPC7rQaav6Iv48rqZwg+F+p8hOMBj0IbxfMdMBrW5pAVGV/ztINByENkU0t5BIJEKRSOQ3Aj+Z57iFs1R5NK3EQS6HQqF1zmQdzpFWq3W42WwOTAf1er1PF2USFlC+qxMvFAr3HcexWX+QX6lUvsKpkTyPSEXJkw6MQ4S38Ljdbi8rmM/nY+CvgNcQqdH6U/xrYK9t244jZv6ByUOSiDdIfgBZ12U6dHEHu9TpdIr8F0OP692CtzaW/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">


                <label>
                    <input class="mrxs js-showPassword-toggle" type="checkbox" value="">
                    <span class="tcs tss">Show password</span>
                </label>
            </fieldset>
            <div class="bdrb mbm mtm mtl--m pbm tac">
                <input class="form-btn btn mbm" data-disable-with="Creating…" name="commit" type="submit" value="Create Free Account">
                <p class="tcs tsm">
                    Already have an account?
                    <a href="https://www.codeschool.com/users/sign_in">Sign in</a>
                </p>
            </div>
            <div class="tac">
                <ul class="list iconList tac">
                    <li class="iconList-item iconList-item--label">Sign up with:</li>
                    <li class="iconList-item">
                        <a href="/auth/github?analytics%5BSign+Up+Page%5D=%2Fusers%2Fsign_up" class="iconList-item-link"><b class="srt">GitHub</b>
                            <i class="icn icn--github iconList-item-icn"></i>
                        </a></li>
                    <li class="iconList-item">
                        <a href="/auth/facebook?analytics%5BSign+Up+Page%5D=%2Fusers%2Fsign_up" class="iconList-item-link"><b class="srt">Facebook</b>
                            <i class="icn icn--facebook iconList-item-icn"></i>
                        </a></li>
                    <li class="iconList-item">
                        <a href="/auth/gplus?analytics%5BSign+Up+Page%5D=%2Fusers%2Fsign_up" class="iconList-item-link"><b class="srt">Google+</b>
                            <i class="icn icn--google iconList-item-icn"></i>
                        </a></li>
                </ul>
            </div>
        </form>

    </div>

</div>

