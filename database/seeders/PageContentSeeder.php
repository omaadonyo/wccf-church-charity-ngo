<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHomePage();
        $this->seedWhoWeArePage();
        $this->seedWhatWeDoPage();
        $this->seedGetInvolvedPage();
        $this->seedDonatePage();
    }

    protected function seedHomePage(): void
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        $page->update(['content' => [
            [
                'id' => 'sec_home_hero',
                'type' => 'hero_slider',
                'data' => [
                    'badge_text' => 'Uganda Registration No. 80020002936115',
                    'slides' => [
                        ['title' => 'Uniting the West Nile Community in Faith', 'subtitle' => 'West Nile Christian Community Fellowship — a faith-based community promoting renewed, healed, and prayerful Christians across Uganda and beyond.', 'image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1600&q=80'],
                        ['title' => 'Worship Together, Grow Together', 'subtitle' => 'Over 70 member churches united in fellowship, worship, and service across Buganda, Busoga and Bunyoro regions.', 'image' => 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80'],
                        ['title' => 'Serving the Needy, Uplifting Communities', 'subtitle' => 'Extending Christ\'s love through charitable assistance, medical outreach, and community development programs.', 'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=1600&q=80'],
                    ],
                    'button_primary_text' => 'Discover Our Story',
                    'button_primary_url' => '/who-we-are',
                    'button_secondary_text' => 'Support Our Mission',
                    'button_secondary_url' => '/donate',
                ],
            ],
            [
                'id' => 'sec_home_stats',
                'type' => 'stats',
                'data' => [
                    'items' => [
                        ['value' => '1990', 'label' => 'Founded', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['value' => '70+', 'label' => 'Member Churches', 'icon' => 'M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m8-10a4 4 0 10-8 0 4 4 0 008 0z'],
                        ['value' => '3', 'label' => 'Regions Served', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['value' => '34+', 'label' => 'Years of Ministry', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ],
                ],
            ],
            [
                'id' => 'sec_home_vision_mission',
                'type' => 'vision_mission',
                'data' => [
                    'vision_heading' => 'Our Vision',
                    'vision_content' => '"A Christian Community Promoting Renewed, Healed and Prayerful Christians"',
                    'mission_heading' => 'Our Mission',
                    'mission_content' => '"To Discover United; Christian Centred Answers to the Current Challenges of Life"',
                ],
            ],
            [
                'id' => 'sec_home_video',
                'type' => 'video',
                'data' => [
                    'heading' => 'Our <span class="text-red">Journey</span>',
                    'caption' => 'See the heart of WCCF — worship, fellowship, and community outreach in action.',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                ],
            ],
            [
                'id' => 'sec_home_about',
                'type' => 'two_column',
                'data' => [
                    'left_label' => 'Who We Are',
                    'left_heading' => 'A Fellowship Rooted in <span class="text-red">Faith & Community</span>',
                    'left_content' => "WCCF transformed from the former Lugbara Christian Community Fellowship (LCCF) founded in 1990. Guided by Hebrews 10:25, we unite the West Nile community in diaspora to fellowship in their own languages.\n\nToday we bring together over 70 member churches spread across Buganda, Busoga and Bunyoro regions.",
                    'right_image' => 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=800&q=80',
                ],
            ],
            [
                'id' => 'sec_home_gallery',
                'type' => 'gallery',
                'data' => [
                    'heading' => 'Moments of <span class="text-red">Fellowship</span>',
                    'subtitle' => 'Glimpses of worship, community gatherings, and outreach across the West Nile region.',
                    'images' => [
                        'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=600&q=80',
                        'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=600&q=80',
                        'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=600&q=80',
                        'https://images.unsplash.com/photo-1593113630400-ea4288922497?w=600&q=80',
                        'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?w=600&q=80',
                        'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80',
                        'https://images.unsplash.com/photo-1476237775687-c9598f74d88d?w=600&q=80',
                        'https://images.unsplash.com/photo-1560520653-9e0e4c89eb11?w=600&q=80',
                        'https://images.unsplash.com/photo-1529543544282-ea07407f1d64?w=600&q=80',
                        'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&q=80',
                        'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&q=80',
                        'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80',
                    ],
                ],
            ],
            [
                'id' => 'sec_home_values',
                'type' => 'values',
                'data' => [
                    'heading' => 'Core Values',
                    'subtitle' => 'The principles that guide every aspect of our fellowship and ministry.',
                    'items' => [
                        ['title' => 'Living Biblically', 'desc' => 'Scripture-centered life and doctrine guiding all we do.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['title' => 'Building Lovely Families', 'desc' => 'Strengthening families as the foundation of Christian community.', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['title' => 'Serving the Needy', 'desc' => 'Extending Christ\'s love through compassionate service.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['title' => 'Uplifting Worship', 'desc' => 'Developing and enriching liturgical worship experiences.', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ],
                ],
            ],
            [
                'id' => 'sec_home_recent_posts',
                'type' => 'recent_posts',
                'data' => [
                    'heading' => 'Latest <span class="text-red">News</span>',
                    'subtitle' => 'UPDATES',
                    'limit' => 3,
                    'background' => 'wwhite',
                ],
            ],
            [
                'id' => 'sec_home_cta',
                'type' => 'cta',
                'data' => [
                    'heading' => 'Join Us in <span class="text-red">Faith & Fellowship</span>',
                    'content' => 'Whether you\'re looking for a spiritual home, want to serve, or need support — WCCF welcomes you. Together, we build a community rooted in Christ.',
                    'button_text' => 'Get Involved',
                    'button_url' => '/get-involved',
                    'button_secondary_text' => 'Make a Donation',
                    'button_secondary_url' => '/donate',
                    'background' => 'white',
                ],
            ],
        ]]);
    }

    protected function seedWhoWeArePage(): void
    {
        $page = Page::where('slug', 'who-we-are')->firstOrFail();
        $page->update(['content' => [
            [
                'id' => 'sec_wwa_hero',
                'type' => 'hero',
                'data' => [
                    'label' => 'About Us',
                    'title' => 'Who We Are',
                    'subtitle' => 'A faith-based, not-for-profit umbrella organization uniting the West Nile community in diaspora through fellowship, worship, and service.',
                ],
            ],
            [
                'id' => 'sec_wwa_story',
                'type' => 'two_column',
                'data' => [
                    'left_label' => 'Our Story',
                    'left_heading' => 'From <span class="text-red">Humble Beginnings</span>',
                    'left_content' => "West Nile Christian Community Fellowship (WCCF) Limited is a faith-based, not-for-profit umbrella organization registered and limited by Guarantee. The organization was incorporated by Uganda Registration Services Bureau (URSB) as a Company Limited by guarantee under Registration No. 80020002936115 on the 25th day of February 2021. The Fellowship is legally operating as a faith-based organization in Uganda and is guided by its Constitution promulgated in July 2011 and as amended in 2019.\n\nWCCF transformed from the former Lugbara Christian Community Fellowship (LCCF) founded in 1990 under the background idea that, since the Lugbara Community were now mixed with different tribes and languages, they could be drawn to worshiping other gods of the land, hence deviating from the true God they know back home.",
                    'right_image' => 'https://images.unsplash.com/photo-1438232997411-2f5e1e7d0d3a?w=800&q=80',
                ],
            ],
            [
                'id' => 'sec_wwa_hebrews',
                'type' => 'text_block',
                'data' => [
                    'label' => 'Scripture Foundation',
                    'heading' => 'Our <span class="text-red">Anchor</span>',
                    'content' => '"Not giving up meeting together, as some are in the habit of doing, but encouraging one another—and all the more as you see the Day approaching." — Hebrews 10:25 (NIV)\n\nThis verse became the anchor and driving motto of the organization, guiding the fellowship to unite the West Nile community in diaspora.',
                ],
            ],
            [
                'id' => 'sec_wwa_growth',
                'type' => 'two_column',
                'data' => [
                    'left_label' => 'Growth',
                    'left_heading' => 'Growth & <span class="text-red">Expansion</span>',
                    'left_content' => "The fellowship started with initially three member churches: St. Francis Chapel Makerere, St. Paul Church Okuvu, and St. John's Church Entebbe. Later, Gabba Church of Uganda joined.\n\nThe core objective of the Fellowship is to unite all the West Nile community in diaspora to fellowship in their own languages, since language barrier was a big challenge to many ethnic West Nile people other than those who can speak English.\n\nThe Fellowship now operates under a constitution written in July 2011 and amended in 2019, bringing together over 70 member churches spread across Buganda, Busoga and Bunyoro regions.",
                    'right_content' => 'A timeline of growth from 3 founding churches to 70+ member churches across 3 regions.',
                ],
            ],
            [
                'id' => 'sec_wwa_vision_mission',
                'type' => 'values',
                'data' => [
                    'heading' => 'Our Foundation',
                    'subtitle' => 'The vision, mission, and values that define and guide WCCF.',
                    'items' => [
                        ['title' => 'Our Vision', 'desc' => '"A Christian Community Promoting Renewed, Healed and Prayerful Christians"', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['title' => 'Our Mission', 'desc' => '"To Discover United; Christian Centred Answers to the Current Challenges of Life"', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['title' => 'Living Biblically', 'desc' => 'Scripture-centered life and doctrine guiding all we do.', 'icon' => 'M5 13l4 4L19 7'],
                        ['title' => 'Building Lovely Families', 'desc' => 'Strengthening families as the foundation of Christian community.', 'icon' => 'M5 13l4 4L19 7'],
                        ['title' => 'Serving Hurting People', 'desc' => 'Extending Christ\'s love through compassionate service to the vulnerable.', 'icon' => 'M5 13l4 4L19 7'],
                        ['title' => 'Uplifting Liturgical Worship', 'desc' => 'Developing and enriching worship experiences that draw people closer to God.', 'icon' => 'M5 13l4 4L19 7'],
                    ],
                ],
            ],
            [
                'id' => 'sec_wwa_objectives',
                'type' => 'text_block',
                'data' => [
                    'label' => 'Our Purpose',
                    'heading' => 'Core <span class="text-red">Objectives</span>',
                    'content' => 'The key objectives that guide the fellowship\'s operations and activities include uniting all the West Nile community in diaspora to fellowship in their own languages, promoting renewed and healed Christians, and extending charitable assistance to those in need throughout Buganda, Busoga and Bunyoro regions.',
                ],
            ],
            [
                'id' => 'sec_wwa_team',
                'type' => 'team',
                'data' => [
                    'heading' => 'Our <span class="text-primary">Leadership</span>',
                    'subtitle' => 'MEET THE TEAM',
                    'items' => [
                        ['name' => 'Rev. John Doe', 'role' => 'Chairperson', 'photo' => '', 'bio' => 'Dedicated servant leader guiding the fellowship with wisdom and faith.'],
                        ['name' => 'Sr. Jane Smith', 'role' => 'Vice Chairperson', 'photo' => '', 'bio' => 'Passionate about community development and Christian fellowship.'],
                        ['name' => 'Bro. James Okello', 'role' => 'General Secretary', 'photo' => '', 'bio' => 'Committed to the administrative and spiritual growth of WCCF.'],
                        ['name' => 'Sr. Grace Nakato', 'role' => 'Treasurer', 'photo' => '', 'bio' => 'Faithful steward of the fellowship\'s resources and finances.'],
                    ],
                    'background' => 'wwhite',
                ],
            ],
            [
                'id' => 'sec_wwa_cta',
                'type' => 'cta',
                'data' => [
                    'heading' => 'Want to Know <span class="text-red">More?</span>',
                    'content' => 'Explore how WCCF serves the community and how you can be part of this mission.',
                    'button_text' => 'What We Do',
                    'button_url' => '/what-we-do',
                    'button_secondary_text' => 'Get Involved',
                    'button_secondary_url' => '/get-involved',
                    'background' => 'navy',
                ],
            ],
        ]]);
    }

    protected function seedWhatWeDoPage(): void
    {
        $page = Page::where('slug', 'what-we-do')->firstOrFail();
        $page->update(['content' => [
            [
                'id' => 'sec_wwd_hero',
                'type' => 'hero',
                'data' => [
                    'label' => 'Our Work',
                    'title' => 'What We Do',
                    'subtitle' => 'Through worship, fellowship, community service, and spiritual development, WCCF serves the West Nile Christian community across Uganda.',
                ],
            ],
            [
                'id' => 'sec_wwd_ministries',
                'type' => 'text_block',
                'data' => [
                    'label' => 'Our Focus',
                    'heading' => 'Areas of <span class="text-red">Ministry</span>',
                    'content' => 'Through worship, fellowship, community service, and spiritual development, WCCF serves the West Nile Christian community across Uganda. Our core areas include uniting member churches, promoting liturgical worship, building lovely families, serving the needy, and developing renewed, healed and prayerful Christians.',
                ],
            ],
            [
                'id' => 'sec_wwd_impact',
                'type' => 'stats',
                'data' => [
                    'heading' => 'Our <span class="text-red">Impact</span>',
                    'items' => [
                        ['value' => '70+', 'label' => 'Member Churches'],
                        ['value' => '3', 'label' => 'Regions Covered'],
                        ['value' => '34+', 'label' => 'Years of Service'],
                        ['value' => '1000s', 'label' => 'Lives Impacted'],
                    ],
                ],
            ],
            [
                'id' => 'sec_wwd_cta',
                'type' => 'cta',
                'data' => [
                    'heading' => 'Partner With <span class="text-red">Us</span>',
                    'content' => 'Your support enables us to continue serving the West Nile Christian community and extending help to those in need.',
                    'button_text' => 'Support Our Work',
                    'button_url' => '/donate',
                    'button_secondary_text' => 'Volunteer With Us',
                    'button_secondary_url' => '/get-involved',
                    'background' => 'navy',
                ],
            ],
        ]]);
    }

    protected function seedGetInvolvedPage(): void
    {
        $page = Page::where('slug', 'get-involved')->firstOrFail();
        $page->update(['content' => [
            [
                'id' => 'sec_gi_hero',
                'type' => 'hero',
                'data' => [
                    'label' => 'Join Us',
                    'title' => 'Get Involved',
                    'subtitle' => 'There are many ways to be part of the WCCF community — whether through membership, volunteering, partnership, or prayer.',
                ],
            ],
            [
                'id' => 'sec_gi_cta',
                'type' => 'cta',
                'data' => [
                    'heading' => 'Ready to <span class="text-red">Get Started?</span>',
                    'content' => 'Take the first step toward becoming part of a vibrant Christian community. Reach out to us today.',
                    'button_text' => 'Support Our Mission',
                    'button_url' => '/donate',
                    'button_secondary_text' => 'Contact Us',
                    'button_secondary_url' => 'mailto:info@wccfuganda.org',
                    'background' => 'white',
                ],
            ],
        ]]);
    }

    protected function seedDonatePage(): void
    {
        $page = Page::where('slug', 'donate')->firstOrFail();
        $page->update(['content' => [
            [
                'id' => 'sec_donate_hero',
                'type' => 'hero',
                'data' => [
                    'label' => 'Support Our Mission',
                    'title' => 'Make a <span class="text-red">Donation</span>',
                    'subtitle' => 'Your generous giving enables WCCF to continue uniting the West Nile community in faith, providing spiritual nourishment, and extending charitable assistance to those in need.',
                ],
            ],
            [
                'id' => 'sec_donate_stewardship',
                'type' => 'text_block',
                'data' => [
                    'label' => 'Financial Integrity',
                    'heading' => 'Faithful <span class="text-red">Stewardship</span>',
                    'content' => 'WCCF is committed to the highest standards of financial integrity and transparency. As a registered company limited by guarantee (Registration No. 80020002936115), we ensure every gift is used responsibly to further the Kingdom of God and serve the West Nile Christian community.',
                ],
            ],
            [
                'id' => 'sec_donate_cta',
                'type' => 'cta',
                'data' => [
                    'heading' => 'Have Questions About Giving?',
                    'content' => 'We would love to hear from you. Reach out to our stewardship team.',
                    'button_text' => 'Email Us',
                    'button_url' => 'mailto:info@wccfuganda.org',
                    'background' => 'navy',
                ],
            ],
        ]]);
    }
}
