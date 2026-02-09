<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Misaf\VendraFaq\Models\FaqCategory;
use Misaf\VendraTenant\Models\Tenant;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::query()->first();

        if ( ! $tenant) {
            $this->command?->error('Tenants not found. Please run TenantSeeder first.');
            return;
        }

        $tenant->makeCurrent();

        $this->seedFaqs($tenant);
    }

    private function seedFaqs(Tenant $tenant): void
    {
        $locales = config('app.supported_locales', ['en', 'fa']);

        $categories = [
            [
                'base_name' => [
                    'en' => 'General Questions',
                    'fa' => 'سوالات عمومی',
                ],
                'base_description' => [
                    'en' => 'Common questions about our platform and services',
                    'fa' => 'سوالات متداول درباره پلتفرم و خدمات ما',
                ],
                'status' => true,
                'faqs'   => [
                    [
                        'base_name' => [
                            'en' => 'What is Vendra and who is it for?',
                            'fa' => 'وندرَا چیست و برای چه کسانی مناسب است؟',
                        ],
                        'base_description' => [
                            'en' => 'Vendra is a modular and multi-tenant CMS designed for startups, SaaS businesses, and enterprise projects. It allows teams to manage content, features, and tenants efficiently.',
                            'fa' => 'وندرَا یک سیستم مدیریت محتوای ماژولار و چندمستاجری است که برای استارتاپ‌ها، کسب‌وکارهای SaaS و پروژه‌های سازمانی طراحی شده است و به تیم‌ها کمک می‌کند محتوا و قابلیت‌ها را به شکل بهینه مدیریت کنند.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Is the system multi-tenant?',
                            'fa' => 'آیا سیستم چندمستاجری است؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes. Each tenant has isolated data and configuration. You can manage multiple tenants from a single application instance.',
                            'fa' => 'بله. هر مستاجر داده‌ها و تنظیمات جداگانه خود را دارد و شما می‌توانید چندین مستاجر را از یک اپلیکیشن مدیریت کنید.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Does the system support multiple languages?',
                            'fa' => 'آیا سیستم از چند زبان پشتیبانی می‌کند؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes, you can configure supported locales in the application settings and store translations in JSON format for flexible multilingual support.',
                            'fa' => 'بله، شما می‌توانید زبان‌های پشتیبانی‌شده را در تنظیمات مشخص کنید و ترجمه‌ها را به صورت JSON ذخیره کنید.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Account & Authentication',
                    'fa' => 'حساب کاربری و احراز هویت',
                ],
                'base_description' => [
                    'en' => 'Questions related to login, registration, and security',
                    'fa' => 'سوالات مربوط به ورود، ثبت‌نام و امنیت',
                ],
                'status' => true,
                'faqs'   => [
                    [
                        'base_name' => [
                            'en' => 'How can I reset my password?',
                            'fa' => 'چگونه می‌توانم رمز عبور خود را بازیابی کنم؟',
                        ],
                        'base_description' => [
                            'en' => 'Click on the "Forgot Password" link on the login page and follow the instructions sent to your email address.',
                            'fa' => 'در صفحه ورود روی گزینه «فراموشی رمز عبور» کلیک کنید و مراحل ارسال‌شده به ایمیل خود را دنبال کنید.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Can I enable two-factor authentication?',
                            'fa' => 'آیا می‌توانم احراز هویت دو مرحله‌ای را فعال کنم؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes, two-factor authentication (2FA) can be enabled from your account security settings for enhanced protection.',
                            'fa' => 'بله، شما می‌توانید از طریق تنظیمات امنیت حساب کاربری، احراز هویت دو مرحله‌ای را برای افزایش امنیت فعال کنید.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'How do I update my profile information?',
                            'fa' => 'چگونه اطلاعات پروفایل خود را ویرایش کنم؟',
                        ],
                        'base_description' => [
                            'en' => 'Navigate to your profile page from the dashboard and update your personal information, then save changes.',
                            'fa' => 'از طریق داشبورد وارد صفحه پروفایل شوید، اطلاعات خود را ویرایش کرده و ذخیره کنید.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Billing & Subscription',
                    'fa' => 'پرداخت و اشتراک',
                ],
                'base_description' => [
                    'en' => 'Information about pricing and subscription plans',
                    'fa' => 'اطلاعات مربوط به قیمت‌گذاری و پلن‌های اشتراک',
                ],
                'status' => true,
                'faqs'   => [
                    [
                        'base_name' => [
                            'en' => 'What payment methods are supported?',
                            'fa' => 'چه روش‌های پرداختی پشتیبانی می‌شود؟',
                        ],
                        'base_description' => [
                            'en' => 'We support credit cards and online payment gateways. Custom integrations are also possible.',
                            'fa' => 'ما از کارت‌های بانکی و درگاه‌های پرداخت آنلاین پشتیبانی می‌کنیم و امکان افزودن درگاه‌های سفارشی نیز وجود دارد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Can I change or cancel my subscription?',
                            'fa' => 'آیا می‌توانم اشتراک خود را تغییر یا لغو کنم؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes, you can upgrade, downgrade, or cancel your subscription anytime from your billing dashboard.',
                            'fa' => 'بله، شما می‌توانید در هر زمان از طریق بخش اشتراک در داشبورد، پلن خود را ارتقا، کاهش یا لغو کنید.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Do you offer refunds?',
                            'fa' => 'آیا بازگشت وجه انجام می‌شود؟',
                        ],
                        'base_description' => [
                            'en' => 'Refunds are handled according to our refund policy. Please contact support for detailed information.',
                            'fa' => 'بازگشت وجه طبق قوانین بازپرداخت انجام می‌شود. برای اطلاعات بیشتر با پشتیبانی تماس بگیرید.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Technical Support',
                    'fa' => 'پشتیبانی فنی',
                ],
                'base_description' => [
                    'en' => 'Technical and development related questions',
                    'fa' => 'سوالات فنی و مرتبط با توسعه',
                ],
                'status' => true,
                'faqs'   => [
                    [
                        'base_name' => [
                            'en' => 'How can I report a bug?',
                            'fa' => 'چگونه می‌توانم یک باگ را گزارش کنم؟',
                        ],
                        'base_description' => [
                            'en' => 'You can report bugs through the support portal or by submitting an issue in the repository with detailed reproduction steps.',
                            'fa' => 'شما می‌توانید از طریق پورتال پشتیبانی یا ثبت Issue در مخزن پروژه همراه با توضیحات کامل، باگ را گزارش کنید.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Is there an API available?',
                            'fa' => 'آیا API در دسترس است؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes, the platform provides RESTful APIs for integration with third-party services and custom applications.',
                            'fa' => 'بله، این پلتفرم APIهای REST برای یکپارچه‌سازی با سرویس‌های دیگر و اپلیکیشن‌های سفارشی ارائه می‌دهد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Can I extend the system with custom modules?',
                            'fa' => 'آیا می‌توانم سیستم را با ماژول‌های سفارشی توسعه دهم؟',
                        ],
                        'base_description' => [
                            'en' => 'Yes, Vendra is designed with modular architecture, allowing developers to create and plug in custom packages easily.',
                            'fa' => 'بله، وندرَا با معماری ماژولار طراحی شده و توسعه‌دهندگان می‌توانند به راحتی پکیج‌های سفارشی ایجاد و اضافه کنند.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $categoryName = $this->buildTranslations($categoryData['base_name'], $locales);
            $categoryDescription = $this->buildTranslations($categoryData['base_description'], $locales);

            $category = FaqCategory::query()->updateOrCreate(
                ['slug' => Str::slug($categoryName['en'])],
                [
                    'name'        => $categoryName,
                    'description' => $categoryDescription,
                    'status'      => $categoryData['status'],
                ],
            );

            foreach ($categoryData['faqs'] as $faqData) {
                $faqName = $this->buildTranslations($faqData['base_name'], $locales);
                $faqDescription = $this->buildTranslations($faqData['base_description'], $locales);

                $category->faqs()->updateOrCreate(
                    ['slug' => Str::slug($faqName['en'])],
                    [
                        'name'        => $faqName,
                        'description' => $faqDescription,
                        'status'      => $faqData['status'],
                    ],
                );
            }
        }

        $this->command?->info("Faqs seeded successfully for {$tenant->slug} tenant.");
    }

    /**
     * @param  array<string, string>  $baseTranslations
     * @param  array<int, string>  $locales
     * @return array<string, string>
     */
    private function buildTranslations(array $baseTranslations, array $locales, string $fallback = 'en'): array
    {
        $translations = [];

        foreach ($locales as $locale) {
            $translations[$locale] = $baseTranslations[$locale] ?? $baseTranslations[$fallback] ?? '';
        }

        return $translations;
    }
}
