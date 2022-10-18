<?php /* Template Name: Contact Us Page Template */ ?>

<?php get_header(); ?>

	<main role="main">
		<?php get_template_part( 'template-parts/banner' ); ?>

		<div class="contact__us__wrapper">
			<div class="text__area">
				<div class="text__area__inner">
					<h1 class="title">
						<?php the_field('title'); ?>
					</h1>

					<div class="address">
						<?php the_field('address_text_area'); ?>
					</div>
					<div class="contact__numbers">
						<?php the_field('contact_numbers_area'); ?>
					</div>
					<div class="opening__hours">
						<?php the_field('opening_hours'); ?>
					</div>
				</div>

				<div class="enquiries__box">
					<h3 class="title__enquiry">
						WHY NOT ENQUIRE TODAY
					</h3>

					<p class="text__area">
						Please fill out the enquiry form below and a member of the team will reply as soon as possible.
					</p>
				</div>
			</div>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2469.8830319716694!2d-2.2941537764434794!3d51.753462399841105!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x797ed36438eb647e!2sCable%20Termination%20Components%20(CTC)!5e0!3m2!1sen!2suk!4v1611755162192!5m2!1sen!2suk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
		</div>
		<div class="contact__form">
			<div class="container">
				<?php gravity_form('Contact Form', false, false, false, '', false); ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
