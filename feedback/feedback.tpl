<!-- BEGIN: MAIN -->
 <div class="card">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-md-auto">
                 {PLUGIN_FEEDBACK_TITLE}
                </div>
                <div class="col-md-auto">
				 {BREADCRUMBS}
				
				</div>
              </div>
            </div>
			</div>
<br>

 <div class="card mb-3">
            <div class="card-header">
              <div class="row flex-between-end">
			  
<main id="plugins">
<div class="container">
		<div class="section-body">

			<div class="form-container form__wrapper">
				<!-- Feedback form -->
				<form id="feedback-form" action="plug/?ajx=feedback" enctype="multipart/form-data" novalidate>

					<!-- User message -->
					<div class="form-group">
						<label for="subject" class="control-label">Mail Başlığı</label>
						<input id="subject" type="text" name="subject" class="form-control" value="" placeholder="subject" minlength="5" maxlength="180" required="required">
						<div class="invalid-feedback"></div>
					</div>

					<div class="form-row">

						<!-- Username -->
						<div class="form-group">
							<label for="name" class="control-label">isim</label>
							<input id="name" type="text" name="name" class="form-control" value="" placeholder="Name" minlength="2" maxlength="30" required="required">
							<div class="invalid-feedback"></div>
						</div>

						<!-- User email -->
						<div class="form-group">
							<label for="email" class="control-label">Email adres</label>
							<input id="email" type="email" name="email" required="required" class="form-control" value="" placeholder="Email address">
							<div class="invalid-feedback"></div>
						</div>

					</div>

					<!-- User message -->
					<div class="form-group">
						<label for="message" class="control-label">Mesaj (en az 20 karakter)</label>
						<textarea id="message" name="message" class="form-control" rows="3" placeholder="Message (at least 20 characters)" minlength="20" maxlength="500" required="required"></textarea>
						<div class="invalid-feedback"></div>
					</div>

					<!-- Files to attach to the form -->
					<div class="form-group form-attach" data-count="5">
						<div class="form-attach__label">Dosyalar (en fazla <span class="form-attach__count">5</span>) olmalı</div>
						<div class="form-attach__wrapper">
							<input type="file" name="attach[]" multiple>
							<div class="form-attach__description">
								<div>Dosyaları yüklemek için tıklayın veya sürükleyip bırakın</div>
								<div class="text-sm">PNG, JPG, GIF, DOC, XLS, PDF (до 2 Mb)</div>
							</div>
							<div class="form-attach__items"></div>
						</div>
						<div class="invalid-feedback"></div>
					</div>

					<!-- Captcha -->
					<div class="form-group form-captcha">
						<img class="form-captcha__image" src="plugins/feedback/captcha/captcha.php" data-src="plugins/feedback/captcha/captcha.php" width="132" height="46" alt="Captcha">
						<div class="form-captcha__refresh">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
								<path fill="currentColor"
									d="M440.65 12.57l4 82.77A247.16 247.16 0 0 0 255.83 8C134.73 8 33.91 94.92 12.29 209.82A12 12 0 0 0 24.09 224h49.05a12 12 0 0 0 11.67-9.26 175.91 175.91 0 0 1 317-56.94l-101.46-4.86a12 12 0 0 0-12.57 12v47.41a12 12 0 0 0 12 12H500a12 12 0 0 0 12-12V12a12 12 0 0 0-12-12h-47.37a12 12 0 0 0-11.98 12.57zM255.83 432a175.61 175.61 0 0 1-146-77.8l101.8 4.87a12 12 0 0 0 12.57-12v-47.4a12 12 0 0 0-12-12H12a12 12 0 0 0-12 12V500a12 12 0 0 0 12 12h47.35a12 12 0 0 0 12-12.6l-4.15-82.57A247.17 247.17 0 0 0 255.83 504c121.11 0 221.93-86.92 243.55-201.82a12 12 0 0 0-11.8-14.18h-49.05a12 12 0 0 0-11.67 9.26A175.86 175.86 0 0 1 255.83 432z">
								</path>
							</svg>
						</div>
						<div class="form-group form-captcha__input">
							<label for="captcha" class="control-label d-none">Resimde gösterilen kod</label>
							<input type="text" name="captcha" maxlength="6" required="required" id="captcha" class="form-control captcha" placeholder="******" autocomplete="off" value="">
							<div class="invalid-feedback"></div>
						</div>
					</div>

					<!-- Terms of use -->
					<div class="form-group form-agree form-check">
						<input class="form-check-input" type="checkbox" name="agree" id="agree" required value="true">
						<label class="form-check-label" for="agree">Buraya tıklayarak şartlar ve koşulları kabul ediyorum. <a href="termsofuse">Aydınlatma metni </a> ve kişisel verilerimin işlenmesine onay veriyorum</label>
						<div class="invalid-feedback"></div>
					</div>

					<!-- Error message -->
					<div class="form-error form-error_hide">Bilgileri düzeltip formu tekrar gönderin.</div>

					<!-- Button to submit the form to the server -->
					<div class="form-submit">
						<button type="submit">Gönder</button>
					</div>

				</form>

				<!-- Message about successful form submission -->
				<div class="form-success form-success_hide">
					<div class="form-success__message">Form başarıyla gönderildi. Başka bir form göndermeniz gerekiyorsa <button type="button" class="form-success__btn">Buraya</button> tıklayın.</div>
				</div>

			</div>

			<script>
				/*
			  attachMaxItems: 3,
			  attachMaxFileSize: 128,
			  attachExt: ['png', 'jpg']
			*/

				const form = new ItcSubmitForm('#feedback-form');

				// при получении ответа result="success" от сервера
				document.querySelector('#feedback-form').addEventListener('success', (e) => {
					const el = e.target.closest('.form-container').querySelector('.form-success');
					el.classList.remove('form-success_hide');
				});

				// при клике на .form-success__btn
				document.querySelector('.form-success__btn').addEventListener('click', (e) => {
					form.reset();
					e.target.closest('.form-container').querySelector('.form-success').classList.add('form-success_hide');
				})
			</script>

		</div>

	</div>

</main>

</div>

		</div>
		
	</div>
<!-- END: MAIN -->