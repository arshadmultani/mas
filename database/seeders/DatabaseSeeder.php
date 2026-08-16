<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Expense;
use App\Models\Faq;
use App\Models\FinancialYear;
use App\Models\Income;
use App\Models\Project;
use App\Models\Report;
use App\Models\SocietyStat;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks for clean truncation in sqlite/mysql
        DB::statement('PRAGMA foreign_keys = OFF;');
        SocietyStat::truncate();
        Faq::truncate();
        Report::truncate();
        Announcement::truncate();
        Transaction::truncate();
        Expense::truncate();
        Income::truncate();
        Project::truncate();
        FinancialYear::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');

        // 1. FINANCIAL YEARS
        $fy2425 = FinancialYear::create([
            'name' => '2024-25',
            'label' => ['hi' => '2024–25', 'en' => '2024–25'],
            'start_date' => '2024-04-01',
            'end_date' => '2025-03-31',
            'target_amount' => 1800000.00,
            'previous_year_income' => 1250000.00,
            'is_current' => false,
        ]);

        $fy2526 = FinancialYear::create([
            'name' => '2025-26',
            'label' => ['hi' => '2025–26', 'en' => '2025–26'],
            'start_date' => '2025-04-01',
            'end_date' => '2026-03-31',
            'target_amount' => 2200000.00,
            'previous_year_income' => 1420000.00,
            'is_current' => false,
        ]);

        $fy2627 = FinancialYear::create([
            'name' => '2026-27',
            'label' => ['hi' => '2026–27', 'en' => '2026–27'],
            'start_date' => '2026-04-01',
            'end_date' => '2027-03-31',
            'target_amount' => 2500000.00,
            'previous_year_income' => 1680000.00, // +18.4% -> (1875000 - 1583000)/... let 1680000 or (1875000 - 1583614)
            'is_current' => true,
        ]);

        // Adjust previous_year_income so growth calculates exactly as +18.4% (or ~18.4%)
        // 1875000 / 1.184 = 1583614.86 -> 1583615
        $fy2627->update(['previous_year_income' => 1583615.00]);

        // 2. PROJECTS FOR 2026-27 (8 Projects)
        $projectsData2627 = [
            [
                'slug' => 'education-support-program',
                'name' => ['hi' => 'शिक्षा सहयोग कार्यक्रम', 'en' => 'Education Support Program'],
                'description' => [
                    'hi' => 'ज़रूरतमंद विद्यार्थियों को छात्रवृत्ति, पाठ्य सामग्री, स्कूल फीस और प्रतियोगी परीक्षाओं की तैयारी हेतु वित्तीय सहायता।',
                    'en' => 'Financial assistance for underprivileged students covering scholarships, books, school fees, and exam coaching.',
                ],
                'budget' => 500000.00,
                'status' => 'ongoing',
                'start_date' => '2026-04-10',
                'end_date' => '2027-03-25',
                'beneficiaries_count' => 450,
                'order' => 1,
            ],
            [
                'slug' => 'community-medical-assistance',
                'name' => ['hi' => 'सामुदायिक चिकित्सा सहायता', 'en' => 'Community Medical Assistance'],
                'description' => [
                    'hi' => 'गंभीर बीमारियों के उपचार, दवाइयों, अस्पताल भर्ती एवं निःशुल्क स्वास्थ्य जांच शिविरों के आयोजन हेतु सहायता कोष।',
                    'en' => 'Emergency medical aid, medicine support, hospitalization assistance, and regular free health checkup camps.',
                ],
                'budget' => 350000.00,
                'status' => 'ongoing',
                'start_date' => '2026-04-15',
                'end_date' => '2027-03-20',
                'beneficiaries_count' => 620,
                'order' => 2,
            ],
            [
                'slug' => 'community-development-initiative',
                'name' => ['hi' => 'सामुदायिक विकास एवं कल्याण पहल', 'en' => 'Community Development Initiative'],
                'description' => [
                    'hi' => 'सामुदायिक परिसंपत्तियों का विकास, सामाजिक सहयोग, स्वच्छता अभियान और महिला सशक्तिकरण कार्यशालाएं।',
                    'en' => 'Development of community assets, social support systems, sanitation drives, and women empowerment workshops.',
                ],
                'budget' => 400000.00,
                'status' => 'ongoing',
                'start_date' => '2026-05-01',
                'end_date' => '2027-02-28',
                'beneficiaries_count' => 850,
                'order' => 3,
            ],
            [
                'slug' => 'annual-community-event',
                'name' => ['hi' => 'वार्षिक सामुदायिक सम्मेलन एवं महोत्सव', 'en' => 'Annual Community Event'],
                'description' => [
                    'hi' => 'वार्षिक स्नेह मिलन समारोह, प्रतिभा सम्मान, सांस्कृतिक कार्यक्रम और समाज के वरिष्ठजनों का नागरिक अभिनंदन।',
                    'en' => 'Annual community gathering, talent felicitation, cultural performances, and honoring senior community elders.',
                ],
                'budget' => 200000.00,
                'status' => 'near_completion',
                'start_date' => '2026-07-01',
                'end_date' => '2026-10-31',
                'beneficiaries_count' => 1200,
                'order' => 4,
            ],
            [
                'slug' => 'youth-skill-development',
                'name' => ['hi' => 'युवा कौशल विकास एवं रोजगार प्रशिक्षण', 'en' => 'Youth Skill Development'],
                'description' => [
                    'hi' => 'युवाओं के लिए डिजिटल साक्षरता, व्यावसायिक कौशल प्रशिक्षण और कैरियर मार्गदर्शन परामर्श सत्र।',
                    'en' => 'Digital literacy programs, vocational job-skills training, and career counseling sessions for youth.',
                ],
                'budget' => 300000.00,
                'status' => 'ongoing',
                'start_date' => '2026-06-01',
                'end_date' => '2027-01-31',
                'beneficiaries_count' => 180,
                'order' => 5,
            ],
            [
                'slug' => 'senior-citizen-welfare',
                'name' => ['hi' => 'वरिष्ठ नागरिक सेवा एवं देखभाल', 'en' => 'Senior Citizen Welfare Support'],
                'description' => [
                    'hi' => 'बुजुर्गों के लिए नियमित स्वास्थ्य जांच, आवश्यक दवाई वितरण और सामाजिक जुड़ाव सत्र।',
                    'en' => 'Routine healthcare monitoring, doorstep medicine delivery, and social engagement sessions for elders.',
                ],
                'budget' => 250000.00,
                'status' => 'ongoing',
                'start_date' => '2026-05-15',
                'end_date' => '2027-03-15',
                'beneficiaries_count' => 210,
                'order' => 6,
            ],
            [
                'slug' => 'library-study-center',
                'name' => ['hi' => 'वाचनालय एवं डिजिटल अध्ययन केंद्र', 'en' => 'Library & Digital Study Center'],
                'description' => [
                    'hi' => 'छात्रों के लिए आधुनिक वाचनालय, ई-लर्निंग संसाधन और संदर्भ पुस्तकों की व्यवस्था।',
                    'en' => 'Modern reading hall, e-learning resources, reference books, and high-speed internet for students.',
                ],
                'budget' => 200000.00,
                'status' => 'near_completion',
                'start_date' => '2026-04-20',
                'end_date' => '2026-11-30',
                'beneficiaries_count' => 340,
                'order' => 7,
            ],
            [
                'slug' => 'emergency-relief-fund',
                'name' => ['hi' => 'आपातकालीन राहत एवं सहायता कोष', 'en' => 'Emergency Relief & Support Fund'],
                'description' => [
                    'hi' => 'प्राकृतिक आपदाओं या आकस्मिक संकट के समय त्वरित मानवीय सहायता और राशन वितरण।',
                    'en' => 'Rapid humanitarian response, essential rations, and direct emergency relief during crises.',
                ],
                'budget' => 300000.00,
                'status' => 'ongoing',
                'start_date' => '2026-04-01',
                'end_date' => '2027-03-31',
                'beneficiaries_count' => 150,
                'order' => 8,
            ],
        ];

        $createdProjects2627 = [];
        foreach ($projectsData2627 as $p) {
            $createdProjects2627[$p['slug']] = Project::create(array_merge($p, [
                'financial_year_id' => $fy2627->id,
            ]));
        }

        // 3. SEED 2026-27 MONTHLY DATA & TRANSACTIONS (Reconciles 100%)
        $incomeCategoryNames = [
            'membership_contributions' => ['hi' => 'सदस्यता अंशदान', 'en' => 'Membership Contributions'],
            'donations' => ['hi' => 'दान एवं सहयोग', 'en' => 'Donations'],
            'community_contributions' => ['hi' => 'सामुदायिक योगदान', 'en' => 'Community Contributions'],
            'events_activities' => ['hi' => 'कार्यक्रम एवं गतिविधियाँ', 'en' => 'Events & Activities'],
            'other_receipts' => ['hi' => 'अन्य प्राप्तियाँ', 'en' => 'Other Receipts'],
        ];

        $expenseCategoryNames = [
            'community_welfare' => ['hi' => 'सामुदायिक कल्याण', 'en' => 'Community Welfare'],
            'education_support' => ['hi' => 'शिक्षा सहयोग', 'en' => 'Education Support'],
            'medical_assistance' => ['hi' => 'चिकित्सा सहायता', 'en' => 'Medical Assistance'],
            'events_cultural' => ['hi' => 'कार्यक्रम एवं सांस्कृतिक गतिविधियाँ', 'en' => 'Events & Cultural Activities'],
            'administrative' => ['hi' => 'प्रशासनिक खर्च', 'en' => 'Administrative Expenses'],
            'infrastructure_maintenance' => ['hi' => 'बुनियादी ढांचा एवं रखरखाव', 'en' => 'Infrastructure / Maintenance'],
            'other_expenses' => ['hi' => 'अन्य खर्च', 'en' => 'Other Expenses'],
        ];

        $preciseMonths2627 = [
            '2026-04' => [
                'incomes' => [
                    ['membership_contributions', 45000, 'वार्षिक सदस्यता शुल्क प्राप्ति - अप्रैल', 'Annual membership fee collection - April', '12 Apr 2026', 'सदस्यता पंजिका'],
                    ['donations', 50000, 'शिक्षा कोष हेतु सामान्य दान', 'General donation for education fund', '18 Apr 2026', 'दान रसीद #1042'],
                    ['community_contributions', 25000, 'सामुदायिक सहयोग राशि', 'Community contribution amount', '24 Apr 2026', 'सामुदायिक कोष'],
                    ['other_receipts', 15000, 'वाचनालय पंजीकरण शुल्क', 'Library registration fees', '28 Apr 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['education_support', 30000, 'सत्रारंभ छात्रवृत्ति वितरण', 'Session start scholarship distribution', '15 Apr 2026', 'छात्रवृत्ति समिति', 'education-support-program'],
                    ['administrative', 12000, 'कार्यालय किराया एवं स्टेशनरी', 'Office rent and stationery', '20 Apr 2026', 'प्रशासनिक व्यय', null],
                    ['infrastructure_maintenance', 25000, 'वाचनालय नवीनीकरण एवं पेंटिंग', 'Library renovation and painting', '26 Apr 2026', 'मेसर्स कृष्णा पेंट्स', 'library-study-center'],
                    ['other_expenses', 15000, 'लेखा परीक्षा एवं विधिक परामर्श', 'Audit and legal consultation fee', '29 Apr 2026', 'सीए विधिक परामर्शदाता', null],
                ],
            ],
            '2026-05' => [
                'incomes' => [
                    ['membership_contributions', 40000, 'मासिक सदस्यता अंशदान - मई', 'Monthly membership contribution - May', '05 May 2026', 'सदस्यता पंजिका'],
                    ['donations', 55000, 'चिकित्सा सहायता दान', 'Medical assistance donation', '14 May 2026', 'दान रसीद #1088'],
                    ['community_contributions', 25000, 'सामुदायिक विकास सहयोग', 'Community development contribution', '21 May 2026', 'सामुदायिक निधि'],
                    ['other_receipts', 22000, 'बैंक ब्याज एवं विविध आय', 'Bank interest and miscellaneous receipts', '29 May 2026', 'एसबीआई बचत खाता'],
                ],
                'expenses' => [
                    ['medical_assistance', 35000, 'मरीजों को आर्थिक सहायता एवं दवाइयां', 'Patient financial assistance and medicine', '10 May 2026', 'उदयपुर मेडिकल स्टोर', 'community-medical-assistance'],
                    ['community_welfare', 28000, 'गर्मी में पेयजल प्याऊ एवं राहत सामग्री', 'Summer drinking water stall and relief', '18 May 2026', 'राहत वितरण समिति', 'community-development-initiative'],
                    ['administrative', 13500, 'इंटरनेट, बिजली एवं दैनिक व्यय', 'Internet, electricity, and daily expenses', '24 May 2026', 'प्रशासनिक व्यय', null],
                    ['other_expenses', 10000, 'वेबसाइट एवं आईटी सिस्टम रखरखाव', 'Website and IT system maintenance', '30 May 2026', 'डिजिटल सॉल्यूशंस', null],
                ],
            ],
            '2026-06' => [
                'incomes' => [
                    ['membership_contributions', 35000, 'सदस्यता अंशदान प्राप्ति', 'Membership contribution receipt', '08 Jun 2026', 'सदस्यता पंजिका'],
                    ['donations', 50000, 'कौशल विकास हेतु विशेष दान', 'Special donation for skill development', '16 Jun 2026', 'दान रसीद #1120'],
                    ['community_contributions', 25000, 'सामुदायिक निधि सहयोग', 'Community fund contribution', '22 Jun 2026', 'सामुदायिक सहयोग'],
                    ['events_activities', 15000, 'योग दिवस कार्यक्रम सहयोग', 'Yoga day event contribution', '21 Jun 2026', 'कार्यक्रम प्रायोजन'],
                    ['other_receipts', 15000, 'विविध प्राप्तियां', 'Miscellaneous receipts', '28 Jun 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['education_support', 40000, 'छात्रों हेतु पाठ्य पुस्तकें एवं कापियां', 'Textbooks and notebooks for students', '12 Jun 2026', 'रजत स्टेशनर्स', 'education-support-program'],
                    ['community_welfare', 25000, 'वरिष्ठ नागरिक स्वास्थ्य शिविर', 'Senior citizen health checkup camp', '19 Jun 2026', 'स्वास्थ्य सेवा समिति', 'senior-citizen-welfare'],
                    ['administrative', 12000, 'कार्यालय व्यय एवं मानदेय', 'Office maintenance and honorarium', '25 Jun 2026', 'कार्यालय कर्मचारी', null],
                    ['infrastructure_maintenance', 5000, 'कंप्यूटर सिस्टम एवं हार्डवेयर अपग्रेड', 'Computer system and hardware upgrade', '29 Jun 2026', 'इन्फोटेक उदयपुर', 'library-study-center'],
                ],
            ],
            '2026-07' => [
                'incomes' => [
                    ['membership_contributions', 45000, 'सदस्यता नवीनीकरण शुल्क', 'Membership renewal fee', '04 Jul 2026', 'सदस्यता पंजिका'],
                    ['donations', 60000, 'अग्रहन दानदाताओं से प्राप्त सहयोग', 'Contributions from society donors', '15 Jul 2026', 'दान रसीद #1185'],
                    ['community_contributions', 35000, 'सामुदायिक सहयोग राशि', 'Community contribution amount', '22 Jul 2026', 'सामुदायिक कोष'],
                    ['other_receipts', 20000, 'सामान्य रसीद प्राप्तियां', 'General receipt collections', '29 Jul 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['education_support', 35000, 'कॉलेज फीस सहायता अनुदान', 'College tuition fee grant', '11 Jul 2026', 'विद्यार्थी सहायता पटल', 'education-support-program'],
                    ['medical_assistance', 25000, 'आपातकालीन चिकित्सा सहायता', 'Emergency medical assistance', '18 Jul 2026', 'अस्पताल सहायता पटल', 'community-medical-assistance'],
                    ['community_welfare', 25000, 'वृक्षारोपण एवं पर्यावरण जागरूकता', 'Tree plantation and environmental drive', '23 Jul 2026', 'पर्यावरण समिति', 'community-development-initiative'],
                    ['administrative', 7000, 'कार्यालय उपयोगिता बिल एवं डाक व्यय', 'Office utilities and postage expense', '30 Jul 2026', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2026-08' => [
                'incomes' => [
                    ['membership_contributions', 35000, 'सदस्यता अंशदान - अगस्त', 'Membership contribution - August', '08 Aug 2026', 'सदस्यता पंजिका'],
                    ['donations', 45000, 'स्वतंत्रता दिवस पर दान', 'Independence Day donation', '15 Aug 2026', 'दान रसीद #1240'],
                    ['community_contributions', 35000, 'सामुदायिक विकास निधि', 'Community development fund', '20 Aug 2026', 'सामुदायिक निधि'],
                    ['other_receipts', 27000, 'वाचनालय सदस्यता एवं अन्य प्राप्तियां', 'Library membership and other receipts', '27 Aug 2026', 'वाचनालय पटल'],
                ],
                'expenses' => [
                    ['events_cultural', 30000, 'स्वतंत्रता दिवस एवं सांस्कृतिक समारोह', 'Independence Day & cultural event', '15 Aug 2026', 'उत्सव आयोजन समिति', 'annual-community-event'],
                    ['community_welfare', 28000, 'वर्षा राहत सामग्री वितरण', 'Monsoon relief distribution', '19 Aug 2026', 'राहत पटल', 'community-development-initiative'],
                    ['education_support', 18500, 'शैक्षणिक सामग्री एवं बैग वितरण', 'Educational kit & bag distribution', '12 Aug 2026', 'शिक्षा समिति', 'education-support-program'],
                    ['administrative', 12500, 'कार्यालय व्यवस्था एवं स्टेशनरी', 'Office stationery and expenses', '29 Aug 2026', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2026-09' => [
                'incomes' => [
                    ['membership_contributions', 32000, 'मासिक सदस्यता अंशदान - सितंबर', 'Monthly membership contribution - Sept', '06 Sep 2026', 'सदस्यता पंजिका'],
                    ['donations', 55000, 'चिकित्सा एवं राहत हेतु दान', 'Medical and relief donation', '14 Sep 2026', 'दान रसीद #1295'],
                    ['community_contributions', 25000, 'सामुदायिक सहयोग निधि', 'Community support fund', '21 Sep 2026', 'सामुदायिक सहयोग'],
                    ['events_activities', 25000, 'शिक्षक दिवस एवं युवा संगोष्ठी सहयोग', 'Teachers day and youth seminar contribution', '05 Sep 2026', 'कार्यक्रम प्रायोजक'],
                    ['other_receipts', 13000, 'विविध प्राप्तियां', 'Miscellaneous receipts', '28 Sep 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['community_welfare', 32000, 'युवा कौशल कार्यशाला आयोजन', 'Youth skill workshop organization', '11 Sep 2026', 'कौशल केंद्र उदयपुर', 'youth-skill-development'],
                    ['medical_assistance', 28000, 'निःशुल्क नेत्र जांच एवं चश्मा वितरण', 'Free eye checkup and spectacles distribution', '17 Sep 2026', 'दृष्टि सेवा संस्थान', 'community-medical-assistance'],
                    ['infrastructure_maintenance', 18000, 'भवन मरम्मत एवं विद्युत कार्य', 'Building repairs and electrical work', '24 Sep 2026', 'राजस्थान इलेक्ट्रिकल्स', null],
                    ['administrative', 10000, 'मासिक प्रशासनिक व्यय', 'Monthly administrative expense', '30 Sep 2026', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2026-10' => [
                'incomes' => [
                    ['donations', 75000, 'दीपावली एवं वार्षिक महोत्सव दान', 'Diwali and annual festive donation', '12 Oct 2026', 'दान रसीद #1360'],
                    ['events_activities', 50000, 'वार्षिक महोत्सव प्रायोजन एवं टिकट', 'Annual festival sponsorship & tickets', '18 Oct 2026', 'महोत्सव प्रायोजक'],
                    ['membership_contributions', 30000, 'सदस्यता अंशदान प्राप्ति', 'Membership contribution receipt', '08 Oct 2026', 'सदस्यता पंजिका'],
                    ['other_receipts', 30000, 'विविध दान एवं रसीदें', 'Miscellaneous donations & receipts', '27 Oct 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['events_cultural', 55000, 'दीपावली स्नेह मिलन एवं मंच व्यवस्था', 'Diwali get-together & stage setup', '19 Oct 2026', 'शर्मा टेंट एंड इवेंट्स', 'annual-community-event'],
                    ['community_welfare', 30000, 'त्योहारी राशन एवं वस्त्र वितरण', 'Festive ration and clothing distribution', '22 Oct 2026', 'सेवा समिति', 'senior-citizen-welfare'],
                    ['administrative', 10000, 'मुद्रण, आमंत्रण पत्र एवं प्रचार', 'Printing, invites, and publicity', '10 Oct 2026', 'उदयपुर प्रिंटर्स', null],
                    ['other_expenses', 17000, 'समारोह व्यवस्था एवं जलपान', 'Event hospitality and refreshments', '29 Oct 2026', 'कैटरिंग सेवा', null],
                ],
            ],
            '2026-11' => [
                'incomes' => [
                    ['membership_contributions', 35000, 'सदस्यता शुल्क - नवंबर', 'Membership fee - November', '06 Nov 2026', 'सदस्यता पंजिका'],
                    ['donations', 55000, 'शिक्षा छात्रवृत्ति कोष दान', 'Education scholarship fund donation', '15 Nov 2026', 'दान रसीद #1420'],
                    ['events_activities', 45000, 'सामुदायिक खेलकूद प्रतियोगिता सहयोग', 'Community sports meet contribution', '20 Nov 2026', 'खेल प्रायोजक'],
                    ['community_contributions', 25000, 'सामुदायिक सहयोग राशि', 'Community contribution amount', '26 Nov 2026', 'सामुदायिक कोष'],
                ],
                'expenses' => [
                    ['community_welfare', 40000, 'शीतकालीन कंबल एवं गर्म कपड़े वितरण', 'Winter blankets and woolens drive', '18 Nov 2026', 'वस्त्र सेवा भंडार', 'community-development-initiative'],
                    ['events_cultural', 35000, 'सामुदायिक खेलकूद व पुरस्कार वितरण', 'Community sports and prize distribution', '22 Nov 2026', 'खेल आयोजन समिति', 'annual-community-event'],
                    ['infrastructure_maintenance', 15000, 'अध्ययन कक्ष फर्नीचर एवं कुर्सी क्रय', 'Study room furniture & seating purchase', '27 Nov 2026', 'मेवाड़ फर्नीचर', 'library-study-center'],
                    ['administrative', 10000, 'कार्यालय व्यय एवं लेखा कार्य', 'Office maintenance & accounting', '30 Nov 2026', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2026-12' => [
                'incomes' => [
                    ['donations', 65000, 'वर्षान्त विशेष कल्याण दान', 'Year-end special welfare donation', '10 Dec 2026', 'दान रसीद #1490'],
                    ['membership_contributions', 30000, 'सदस्यता अंशदान प्राप्ति', 'Membership contribution receipt', '05 Dec 2026', 'सदस्यता पंजिका'],
                    ['community_contributions', 35000, 'सामुदायिक स्वास्थ्य कोष सहयोग', 'Community health fund contribution', '18 Dec 2026', 'सामुदायिक कोष'],
                    ['events_activities', 20000, 'नववर्ष पूर्व समारोह सहयोग', 'Pre-New Year event support', '24 Dec 2026', 'कार्यक्रम प्रायोजक'],
                    ['other_receipts', 15000, 'अन्य विविध प्राप्तियां', 'Other miscellaneous receipts', '30 Dec 2026', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['education_support', 32000, 'अर्द्धवार्षिक परीक्षा शुल्क एवं शिक्षण सहायता', 'Mid-term exam fee & tuition aid', '08 Dec 2026', 'शिक्षा समिति', 'education-support-program'],
                    ['community_welfare', 36000, 'शीतकालीन आश्रय एवं राहत सहायता', 'Winter shelter and relief assistance', '16 Dec 2026', 'राहत सेवा पटल', 'emergency-relief-fund'],
                    ['medical_assistance', 22000, 'नियमित चिकित्सा सहायता व दवा वितरण', 'Regular medical aid & medicine supply', '23 Dec 2026', 'चिकित्सा समिति', 'community-medical-assistance'],
                    ['administrative', 12000, 'कार्यालय व्यवस्था एवं लेखा प्रणाली नवीनीकरण', 'Office management & ERP renewal', '31 Dec 2026', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2027-01' => [
                'incomes' => [
                    ['donations', 55000, 'गणतंत्र दिवस एवं समाज कल्याण दान', 'Republic Day & welfare donation', '12 Jan 2027', 'दान रसीद #1550'],
                    ['membership_contributions', 30000, 'सदस्यता शुल्क - जनवरी', 'Membership fee - January', '07 Jan 2027', 'सदस्यता पंजिका'],
                    ['community_contributions', 35000, 'सामुदायिक सहयोग राशि', 'Community contribution amount', '19 Jan 2027', 'सामुदायिक कोष'],
                    ['events_activities', 20000, 'सांस्कृतिक कार्यक्रम प्रायोजन', 'Cultural event sponsorship', '25 Jan 2027', 'कार्यक्रम प्रायोजक'],
                    ['other_receipts', 20000, 'विविध प्राप्तियां', 'Miscellaneous receipts', '30 Jan 2027', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['community_welfare', 32000, 'सामुदायिक सेवा एवं भोजन वितरण', 'Community service and food distribution', '15 Jan 2027', 'अन्न सेवा समिति', 'community-development-initiative'],
                    ['events_cultural', 25000, 'गणतंत्र दिवस समारोह आयोजन', 'Republic Day celebrations', '26 Jan 2027', 'समारोह समिति', 'annual-community-event'],
                    ['infrastructure_maintenance', 30000, 'सामुदायिक भवन हॉल सुदृढ़ीकरण', 'Community hall enhancement & lighting', '20 Jan 2027', 'जयेश कंस्ट्रक्शन', null],
                    ['administrative', 11000, 'मासिक प्रशासनिक एवं संचालन व्यय', 'Monthly administrative & running cost', '31 Jan 2027', 'प्रशासनिक व्यय', null],
                ],
            ],
            '2027-02' => [
                'incomes' => [
                    ['donations', 65000, 'शिक्षा एवं चिकित्सा कोष दान', 'Education & medical fund donation', '10 Feb 2027', 'दान रसीद #1610'],
                    ['membership_contributions', 38000, 'सदस्यता अंशदान - फ़रवरी', 'Membership contribution - Feb', '05 Feb 2027', 'सदस्यता पंजिका'],
                    ['community_contributions', 35000, 'सामुदायिक निधि सहयोग', 'Community fund contribution', '17 Feb 2027', 'सामुदायिक कोष'],
                    ['events_activities', 15000, 'वसन्त उत्सव कार्यक्रम सहयोग', 'Vasant Utsav event support', '22 Feb 2027', 'कार्यक्रम प्रायोजक'],
                    ['other_receipts', 23000, 'विविध शुल्क प्राप्तियां', 'Miscellaneous fees and receipts', '27 Feb 2027', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['community_welfare', 34000, 'कौशल विकास प्रमाणपत्र वितरण एवं सेमिनार', 'Skill development certificates & seminar', '12 Feb 2027', 'कौशल पटल', 'youth-skill-development'],
                    ['education_support', 29500, 'बोर्ड परीक्षा तैयारी सामग्री सहायता', 'Board exam study material assistance', '18 Feb 2027', 'शिक्षा समिति', 'education-support-program'],
                    ['events_cultural', 20000, 'प्रतिभा सम्मान समारोह व्यय', 'Talent felicitation event expenses', '24 Feb 2027', 'उत्सव समिति', 'annual-community-event'],
                    ['other_expenses', 17500, 'सामुदायिक जनसंपर्क एवं संचार', 'Community outreach & communication', '28 Feb 2027', 'संचार सेवा', null],
                ],
            ],
            '2027-03' => [
                'incomes' => [
                    ['donations', 50000, 'वित्तीय वर्ष समाप्ति विशेष दान', 'Financial year-end special donation', '15 Mar 2027', 'दान रसीद #1690'],
                    ['membership_contributions', 30000, 'अंतिम तिमाही सदस्यता अंशदान', 'Final quarter membership contribution', '08 Mar 2027', 'सदस्यता पंजिका'],
                    ['community_contributions', 20000, 'सामुदायिक वार्षिक समेकित अंशदान', 'Community annual consolidated fund', '20 Mar 2027', 'सामुदायिक कोष'],
                    ['events_activities', 20000, 'होली मिलन समारोह सहयोग', 'Holi Milan festival contribution', '24 Mar 2027', 'कार्यक्रम प्रायोजक'],
                    ['other_receipts', 40000, 'वर्षान्त विविध समायोजन एवं प्राप्तियां', 'Year-end miscellaneous receipts', '28 Mar 2027', 'कार्यालय रसीद'],
                ],
                'expenses' => [
                    ['infrastructure_maintenance', 37000, 'वार्षिक रखरखाव एवं मरम्मत', 'Annual facility maintenance & repair', '25 Mar 2027', 'मरम्मत समिति', null],
                    ['medical_assistance', 30000, 'आपातकालीन चिकित्सा सहायता वितरण', 'Emergency medical aid disbursement', '19 Mar 2027', 'चिकित्सा पटल', 'community-medical-assistance'],
                    ['other_expenses', 40500, 'वित्तीय ऑडिट एवं अंतिम लेखा समीक्षा', 'Financial audit & final accounts review', '29 Mar 2027', 'लेखा परीक्षक दल', null],
                    ['administrative', 2500, 'बैंक शुल्क एवं विविध प्रभार', 'Bank charges and miscellaneous', '31 Mar 2027', 'बैंक एवं डाक प्रभार', null],
                ],
            ],
        ];

        // Seed 2026-27 detailed Incomes, Expenses, and Ledger Transactions
        $refIndex = 1000;
        foreach ($preciseMonths2627 as $monthKey => $monthData) {
            foreach ($monthData['incomes'] as $inc) {
                $categoryKey = $inc[0];
                $amt = (float) $inc[1];
                $descHi = $inc[2];
                $descEn = $inc[3];
                $dateStr = $inc[4] ?? $monthKey.'-15';
                $src = $inc[5] ?? 'कार्यालय';
                $date = Carbon::parse($dateStr)->format('Y-m-d');
                $refIndex++;

                $incomeRecord = Income::create([
                    'financial_year_id' => $fy2627->id,
                    'date' => $date,
                    'category' => $categoryKey,
                    'category_name' => $incomeCategoryNames[$categoryKey],
                    'description' => ['hi' => $descHi, 'en' => $descEn],
                    'source' => ['hi' => $src, 'en' => $src],
                    'amount' => $amt,
                ]);

                Transaction::create([
                    'financial_year_id' => $fy2627->id,
                    'date' => $date,
                    'type' => 'income',
                    'category' => $categoryKey,
                    'category_name' => $incomeCategoryNames[$categoryKey],
                    'description' => ['hi' => $descHi, 'en' => $descEn],
                    'amount' => $amt,
                    'reference_no' => 'MAS-INC-'.$refIndex,
                    'project_id' => null,
                ]);
            }

            foreach ($monthData['expenses'] as $exp) {
                $categoryKey = $exp[0];
                $amt = (float) $exp[1];
                $descHi = $exp[2];
                $descEn = $exp[3];
                $dateStr = $exp[4] ?? $monthKey.'-15';
                $vendor = $exp[5] ?? 'अधिकृत विक्रेता';
                $projSlug = $exp[6] ?? null;
                $projectId = $projSlug && isset($createdProjects2627[$projSlug]) ? $createdProjects2627[$projSlug]->id : null;
                $date = Carbon::parse($dateStr)->format('Y-m-d');
                $refIndex++;

                $expenseRecord = Expense::create([
                    'financial_year_id' => $fy2627->id,
                    'project_id' => $projectId,
                    'date' => $date,
                    'category' => $categoryKey,
                    'category_name' => $expenseCategoryNames[$categoryKey],
                    'description' => ['hi' => $descHi, 'en' => $descEn],
                    'vendor' => ['hi' => $vendor, 'en' => $vendor],
                    'amount' => $amt,
                ]);

                Transaction::create([
                    'financial_year_id' => $fy2627->id,
                    'date' => $date,
                    'type' => 'expense',
                    'category' => $categoryKey,
                    'category_name' => $expenseCategoryNames[$categoryKey],
                    'description' => ['hi' => $descHi, 'en' => $descEn],
                    'amount' => $amt,
                    'reference_no' => 'MAS-EXP-'.$refIndex,
                    'project_id' => $projectId,
                ]);
            }
        }

        // 4. SEED HISTORICAL YEARS 2025-26 & 2024-25 (Reconciled)
        // 2025-26: Total In 16,80,000 | Total Ex 10,90,000 | Target 22,00,000 | Bal 5,90,000
        $historicalMonths2526 = [
            4 => [115000, 75000],
            5 => [125000, 80000],
            6 => [120000, 78000],
            7 => [140000, 88000],
            8 => [120000, 80000],
            9 => [135000, 85000],
            10 => [160000, 100000],
            11 => [140000, 92000],
            12 => [150000, 98000],
            1 => [145000, 92000],
            2 => [150000, 95000],
            3 => [180000, 127000],
        ];

        foreach ($historicalMonths2526 as $mNum => $vals) {
            $yearNum = $mNum >= 4 ? 2025 : 2026;
            $d = sprintf('%04d-%02d-15', $yearNum, $mNum);

            Income::create([
                'financial_year_id' => $fy2526->id,
                'date' => $d,
                'category' => 'donations',
                'category_name' => $incomeCategoryNames['donations'],
                'description' => ['hi' => 'मासिक समेकित आय', 'en' => 'Monthly consolidated income'],
                'amount' => $vals[0],
            ]);

            Expense::create([
                'financial_year_id' => $fy2526->id,
                'date' => $d,
                'category' => 'community_welfare',
                'category_name' => $expenseCategoryNames['community_welfare'],
                'description' => ['hi' => 'मासिक समेकित खर्च', 'en' => 'Monthly consolidated expense'],
                'amount' => $vals[1],
            ]);

            Transaction::create([
                'financial_year_id' => $fy2526->id,
                'date' => $d,
                'type' => 'income',
                'category' => 'donations',
                'category_name' => $incomeCategoryNames['donations'],
                'description' => ['hi' => 'मासिक समेकित आय प्राप्ति', 'en' => 'Monthly consolidated income receipt'],
                'amount' => $vals[0],
                'reference_no' => 'MAS-FY25-INC-'.$mNum,
            ]);

            Transaction::create([
                'financial_year_id' => $fy2526->id,
                'date' => $d,
                'type' => 'expense',
                'category' => 'community_welfare',
                'category_name' => $expenseCategoryNames['community_welfare'],
                'description' => ['hi' => 'मासिक समेकित खर्च भुगतान', 'en' => 'Monthly consolidated expenditure'],
                'amount' => $vals[1],
                'reference_no' => 'MAS-FY25-EXP-'.$mNum,
            ]);
        }

        // 2024-25: Total In 14,20,000 | Total Ex 9,80,000 | Target 18,00,000 | Bal 4,40,000
        $historicalMonths2425 = [
            4 => [95000, 65000],
            5 => [105000, 72000],
            6 => [100000, 68000],
            7 => [120000, 78000],
            8 => [100000, 70000],
            9 => [115000, 75000],
            10 => [135000, 90000],
            11 => [115000, 80000],
            12 => [125000, 85000],
            1 => [120000, 80000],
            2 => [125000, 82000],
            3 => [165000, 135000],
        ];

        foreach ($historicalMonths2425 as $mNum => $vals) {
            $yearNum = $mNum >= 4 ? 2024 : 2025;
            $d = sprintf('%04d-%02d-15', $yearNum, $mNum);

            Income::create([
                'financial_year_id' => $fy2425->id,
                'date' => $d,
                'category' => 'donations',
                'category_name' => $incomeCategoryNames['donations'],
                'description' => ['hi' => 'मासिक समेकित आय', 'en' => 'Monthly consolidated income'],
                'amount' => $vals[0],
            ]);

            Expense::create([
                'financial_year_id' => $fy2425->id,
                'date' => $d,
                'category' => 'community_welfare',
                'category_name' => $expenseCategoryNames['community_welfare'],
                'description' => ['hi' => 'मासिक समेकित खर्च', 'en' => 'Monthly consolidated expense'],
                'amount' => $vals[1],
            ]);

            Transaction::create([
                'financial_year_id' => $fy2425->id,
                'date' => $d,
                'type' => 'income',
                'category' => 'donations',
                'category_name' => $incomeCategoryNames['donations'],
                'description' => ['hi' => 'मासिक समेकित आय प्राप्ति', 'en' => 'Monthly consolidated income receipt'],
                'amount' => $vals[0],
                'reference_no' => 'MAS-FY24-INC-'.$mNum,
            ]);

            Transaction::create([
                'financial_year_id' => $fy2425->id,
                'date' => $d,
                'type' => 'expense',
                'category' => 'community_welfare',
                'category_name' => $expenseCategoryNames['community_welfare'],
                'description' => ['hi' => 'मासिक समेकित खर्च भुगतान', 'en' => 'Monthly consolidated expenditure'],
                'amount' => $vals[1],
                'reference_no' => 'MAS-FY24-EXP-'.$mNum,
            ]);
        }

        // 5. ANNOUNCEMENTS (10+ realistic items in Hindi & English)
        $announcementsData = [
            [
                'title' => [
                    'hi' => 'वार्षिक वित्तीय सारांश 2025–26 सार्वजनिक निरीक्षण हेतु प्रकाशित',
                    'en' => 'Annual Financial Summary for 2025–26 Published for Public Review',
                ],
                'description' => [
                    'hi' => 'सोसाइटी की प्रबंध कार्यकारिणी द्वारा स्वीकृत वर्ष 2025–26 का अंतिम वित्तीय विवरण पोर्टल के रिपोर्ट अनुभाग में अपलोड कर दिया गया है।',
                    'en' => 'The finalized financial statement for FY 2025–26 approved by the governing body has been uploaded in the reports section.',
                ],
                'tag' => ['hi' => 'वित्तीय रिपोर्ट', 'en' => 'Financial Report'],
                'published_at' => '2026-08-16',
                'order' => 1,
            ],
            [
                'title' => [
                    'hi' => 'शिक्षा सहयोग कार्यक्रम द्वितीय चरण का सफल शुभारंभ',
                    'en' => 'Education Support Program Phase II Launched Successfully',
                ],
                'description' => [
                    'hi' => 'सत्र 2026–27 के तहत 120 नए विद्यार्थियों को उच्च शिक्षा एवं तकनीकी पाठ्यक्रमों हेतु छात्रवृत्ति वितरित की गई।',
                    'en' => 'Under FY 2026–27, 120 new students were awarded scholarships for higher education and technical vocational courses.',
                ],
                'tag' => ['hi' => 'शिक्षा पहल', 'en' => 'Education Initiative'],
                'published_at' => '2026-08-10',
                'order' => 2,
            ],
            [
                'title' => [
                    'hi' => 'सामुदायिक सहयोग अभियान ने वार्षिक लक्ष्य का 75% पूर्ण किया',
                    'en' => 'Community Contribution Drive Reaches 75% of Annual Target',
                ],
                'description' => [
                    'hi' => 'दानदाताओं और समाज बंधुओं के निरंतर सहयोग से वित्तीय वर्ष 2026–27 का कुल संकलन ₹18.75 लाख पार कर गया है।',
                    'en' => 'With the continuous support of community members, total collections for FY 2026–27 have crossed ₹18.75 Lakhs.',
                ],
                'tag' => ['hi' => 'मील का पत्थर', 'en' => 'Milestone'],
                'published_at' => '2026-08-01',
                'order' => 3,
            ],
            [
                'title' => [
                    'hi' => 'उदयपुर में निःशुल्क बहु-विशिष्ट चिकित्सा शिविर 25 अगस्त को',
                    'en' => 'Free Multi-Specialty Health Camp in Udaipur on 25 August',
                ],
                'description' => [
                    'hi' => 'मुल्तानी भवन में वरिष्ठ चिकित्सकों द्वारा हृदय, नेत्र एवं सामान्य स्वास्थ्य जांच व निःशुल्क दवा वितरण किया जाएगा।',
                    'en' => 'Senior doctors will provide cardiac, ophthalmic, and general health checkups with free medicine distribution.',
                ],
                'tag' => ['hi' => 'स्वास्थ्य सेवा', 'en' => 'Health Service'],
                'published_at' => '2026-07-28',
                'order' => 4,
            ],
            [
                'title' => [
                    'hi' => 'डिजिटल वाचनालय में 500 नई संदर्भ पुस्तकें एवं ई-लर्निंग टैबलेट शामिल',
                    'en' => '500 New Reference Books & E-Learning Tablets Added to Digital Library',
                ],
                'description' => [
                    'hi' => 'प्रतियोगी परीक्षाओं की तैयारी कर रहे छात्रों के अध्ययन हेतु केंद्र को नवीनतम अध्ययन सामग्री से सुसज्जित किया गया है।',
                    'en' => 'The study center has been upgraded with the latest study resources for students preparing for competitive exams.',
                ],
                'tag' => ['hi' => 'सुविधा विस्तार', 'en' => 'Facility Upgrade'],
                'published_at' => '2026-07-15',
                'order' => 5,
            ],
            [
                'title' => [
                    'hi' => 'युवा कौशल विकास बैच 3 के नामांकन प्रारंभ',
                    'en' => 'Enrollment Open for Youth Skill Development Batch 3',
                ],
                'description' => [
                    'hi' => 'कंप्यूटर एकाउंटिंग, वेब डिजाइन और डिजिटल मार्केटिंग में 3 माह का निःशुल्क प्रशिक्षण उपलब्ध।',
                    'en' => 'Free 3-month practical training in computer accounting, web design, and digital marketing.',
                ],
                'tag' => ['hi' => 'कौशल विकास', 'en' => 'Skill Training'],
                'published_at' => '2026-07-02',
                'order' => 6,
            ],
            [
                'title' => [
                    'hi' => 'वरिष्ठ नागरिक सम्मान एवं स्वास्थ्य देखभाल योजना का विस्तार',
                    'en' => 'Senior Citizen Felicitation & Healthcare Support Scheme Expanded',
                ],
                'description' => [
                    'hi' => 'घर-घर नियमित स्वास्थ्य जांच एवं आवश्यक दवाइयों की सुगम आपूर्ति हेतु विशेष स्वयंसेवक दल का गठन।',
                    'en' => 'A dedicated volunteer team formed to facilitate regular doorstep health checks and medication delivery.',
                ],
                'tag' => ['hi' => 'वरिष्ठ सेवा', 'en' => 'Senior Welfare'],
                'published_at' => '2026-06-20',
                'order' => 7,
            ],
            [
                'title' => [
                    'hi' => 'पारदर्शिता एवं आंतरिक ऑडिट रिपोर्ट 2025–26 को कार्यकारिणी से अनुमोदन',
                    'en' => 'Transparency & Internal Audit Report 2025–26 Approved by Board',
                ],
                'description' => [
                    'hi' => 'स्वतंत्र चार्टर्ड एकाउंटेंट्स द्वारा सत्यापित वार्षिक वित्तीय खाते बिना किसी आपत्ति के सर्वसम्मति से स्वीकृत हुए।',
                    'en' => 'Audited accounts verified by independent Chartered Accountants were approved without qualification.',
                ],
                'tag' => ['hi' => 'ऑडिट एवं गवर्नेंस', 'en' => 'Audit & Governance'],
                'published_at' => '2026-05-30',
                'order' => 8,
            ],
            [
                'title' => [
                    'hi' => 'पर्यावरण एवं हरित उदयपुर अभियान के तहत 1,000 पौधों का रोपण',
                    'en' => '1,000 Saplings Planted Under Green Udaipur Environmental Drive',
                ],
                'description' => [
                    'hi' => 'सामुदायिक परिसरों और सार्वजनिक स्थानों पर छायादार व फलदार पौधों का संरक्षण कार्य शुरू।',
                    'en' => 'Plantation and caretaking drive launched across community premises and public spaces.',
                ],
                'tag' => ['hi' => 'पर्यावरण', 'en' => 'Environment'],
                'published_at' => '2026-05-12',
                'order' => 9,
            ],
            [
                'title' => [
                    'hi' => 'वार्षिक बजट योजना 2026–27 को आमसभा द्वारा अंतिम मंजूरी',
                    'en' => 'Annual Budget Plan 2026–27 Granted Final Approval by General Assembly',
                ],
                'description' => [
                    'hi' => 'कुल ₹25 लाख के स्वीकृत वार्षिक बजट का विस्तृत मदवार विभाजन पोर्टल पर उपलब्ध कराया गया।',
                    'en' => 'Detailed category-wise allocations for the approved ₹25 Lakh annual budget are published on the portal.',
                ],
                'tag' => ['hi' => 'बजट अनुमोदन', 'en' => 'Budget Approval'],
                'published_at' => '2026-04-05',
                'order' => 10,
            ],
        ];

        foreach ($announcementsData as $ann) {
            Announcement::create($ann);
        }

        // 6. REPORTS & DOCUMENTS (6 items with PDF/Download paths)
        $reportsData = [
            [
                'financial_year_id' => $fy2627->id,
                'title' => [
                    'hi' => 'वार्षिक बजट एवं वित्तीय योजना सारांश 2026–27',
                    'en' => 'Annual Budget & Financial Plan Summary 2026–27',
                ],
                'type' => 'budget',
                'file_path' => 'reports/mas_budget_summary_2026_27.pdf',
                'file_size' => '1.4 MB',
                'published_at' => '2026-04-10',
                'order' => 1,
            ],
            [
                'financial_year_id' => $fy2526->id,
                'title' => [
                    'hi' => 'वार्षिक वित्तीय लेखा-परीक्षण रिपोर्ट 2025–26',
                    'en' => 'Annual Financial Audit Report 2025–26',
                ],
                'type' => 'audit',
                'file_path' => 'reports/mas_audit_report_2025_26.pdf',
                'file_size' => '2.1 MB',
                'published_at' => '2026-06-15',
                'order' => 2,
            ],
            [
                'financial_year_id' => $fy2526->id,
                'title' => [
                    'hi' => 'वार्षिक सामाजिक गतिविधि एवं प्रभाव रिपोर्ट 2025–26',
                    'en' => 'Annual Activity & Social Impact Report 2025–26',
                ],
                'type' => 'activity',
                'file_path' => 'reports/mas_activity_report_2025_26.pdf',
                'file_size' => '3.8 MB',
                'published_at' => '2026-06-25',
                'order' => 3,
            ],
            [
                'financial_year_id' => $fy2425->id,
                'title' => [
                    'hi' => 'वार्षिक वित्तीय रिपोर्ट 2024–25 (ऑडिटेड)',
                    'en' => 'Annual Financial Report 2024–25 (Audited)',
                ],
                'type' => 'financial',
                'file_path' => 'reports/mas_financial_report_2024_25.pdf',
                'file_size' => '1.9 MB',
                'published_at' => '2025-06-20',
                'order' => 4,
            ],
            [
                'financial_year_id' => $fy2425->id,
                'title' => [
                    'hi' => 'वार्षिक गतिविधि सारांश 2024–25',
                    'en' => 'Annual Activity Summary 2024–25',
                ],
                'type' => 'activity',
                'file_path' => 'reports/mas_activity_report_2024_25.pdf',
                'file_size' => '2.4 MB',
                'published_at' => '2025-07-05',
                'order' => 5,
            ],
            [
                'financial_year_id' => null,
                'title' => [
                    'hi' => 'सोसाइटी वित्तीय नियम एवं पारदर्शिता नियमावली',
                    'en' => 'Society Financial Guidelines & Transparency Bylaws',
                ],
                'type' => 'financial',
                'file_path' => 'reports/mas_transparency_bylaws.pdf',
                'file_size' => '850 KB',
                'published_at' => '2026-01-10',
                'order' => 6,
            ],
        ];

        foreach ($reportsData as $rep) {
            Report::create($rep);
        }

        // 7. SOCIETY STATS (4 Key Statistics)
        $statsData = [
            [
                'key' => 'members',
                'label' => ['hi' => 'सामुदायिक सदस्य', 'en' => 'Community Members'],
                'value' => '1,250+',
                'subtext' => ['hi' => 'सक्रिय पंजीकृत परिवार', 'en' => 'Active registered families'],
                'order' => 1,
            ],
            [
                'key' => 'beneficiaries',
                'label' => ['hi' => 'वार्षिक लाभार्थी', 'en' => 'Annual Beneficiaries'],
                'value' => '2,800+',
                'subtext' => ['hi' => 'शिक्षा, चिकित्सा व राहत प्राप्तकर्ता', 'en' => 'Education, medical & relief recipients'],
                'order' => 2,
            ],
            [
                'key' => 'initiatives',
                'label' => ['hi' => 'सक्रिय पहल', 'en' => 'Active Initiatives'],
                'value' => '8',
                'subtext' => ['hi' => 'सतत कल्याणकारी परियोजनाएं', 'en' => 'Ongoing welfare projects'],
                'order' => 3,
            ],
            [
                'key' => 'funds_received',
                'label' => ['hi' => 'कुल प्राप्त राशि', 'en' => 'Funds Received'],
                'value' => '₹18.75L',
                'subtext' => ['hi' => 'सत्र 2026–27 में अब तक', 'en' => 'In FY 2026–27 to date'],
                'order' => 4,
            ],
        ];

        foreach ($statsData as $st) {
            SocietyStat::create($st);
        }

        // 8. FAQS (6 comprehensive questions in Hindi & English)
        $faqsData = [
            [
                'question' => [
                    'hi' => 'वित्तीय जानकारी कितनी बार अपडेट की जाती है?',
                    'en' => 'How often is the financial information updated?',
                ],
                'answer' => [
                    'hi' => 'सार्वजनिक डैशबोर्ड को समय-समय पर अपडेट किया जाता है, जैसे ही वित्तीय अभिलेखों की समीक्षा और समेकन पूर्ण होता है। प्रत्येक लेनदेन को लेज़र में दर्ज करने के बाद डेटाबेस में अद्यतन किया जाता है।',
                    'en' => 'The public dashboard is updated periodically as financial records are reviewed and consolidated. Transactions are added after standard ledger verification.',
                ],
                'order' => 1,
            ],
            [
                'question' => [
                    'hi' => 'क्या प्रदर्शित शेष राशि सोसाइटी के संपूर्ण बैंक बैलेंस का प्रतिनिधित्व करती है?',
                    'en' => 'Does the balance shown represent the society’s entire bank balance?',
                ],
                'answer' => [
                    'hi' => 'यह वर्तमान में डेमो डेटा है। वास्तविक उत्पादन संस्करण में स्पष्ट रूप से परिभाषित किया जाएगा कि कौन से खाते, नकद शेष और रिपोर्टिंग अवधियां इसमें शामिल हैं।',
                    'en' => 'Demo data only. The production version clearly defines what accounts, designated funds, cash balances, and reporting periods are included.',
                ],
                'order' => 2,
            ],
            [
                'question' => [
                    'hi' => 'क्या मैं पिछले वर्षों के वित्तीय रिकॉर्ड देख सकता हूँ?',
                    'en' => 'Can I view previous financial years?',
                ],
                'answer' => [
                    'hi' => 'हाँ। आप वित्तीय वर्ष चयनकर्ता (Financial Year Selector) का उपयोग करके पिछले वर्षों (2025–26, 2024–25) के स्वीकृत वित्तीय डेटा और ऐतिहासिक तुलना का अवलोकन कर सकते हैं।',
                    'en' => 'Yes. Use the financial-year selector in the navigation bar to view historical records (2025–26, 2024–25) and multi-year comparisons.',
                ],
                'order' => 3,
            ],
            [
                'question' => [
                    'hi' => 'क्या मैं विस्तृत वित्तीय और ऑडिट रिपोर्ट डाउनलोड कर सकता हूँ?',
                    'en' => 'Can I download detailed reports and audit summaries?',
                ],
                'answer' => [
                    'hi' => 'हाँ। "रिपोर्ट और दस्तावेज़" अनुभाग में जाकर आप वार्षिक वित्तीय रिपोर्ट, बजट योजनाएं और स्वतंत्र चार्टर्ड एकाउंटेंट की ऑडिट रिपोर्ट PDF प्रारूप में डाउनलोड कर सकते हैं।',
                    'en' => 'Yes. You can download official annual financial summaries, budget plans, and independent audit reports in PDF format from the Reports & Documents section.',
                ],
                'order' => 4,
            ],
            [
                'question' => [
                    'hi' => 'किसी प्रविष्टि या स्पष्टीकरण के लिए किससे संपर्क किया जाए?',
                    'en' => 'Who can I contact for financial clarifications or donor queries?',
                ],
                'answer' => [
                    'hi' => 'आप पृष्ठ के निचले भाग में दिए गए "संपर्क करें" अनुभाग में उपलब्ध ईमेल, हेल्पलाइन नंबर या कार्यालय समय में सीधे मुल्तानी भवन, टाउन हॉल रोड, उदयपुर आकर संपर्क कर सकते हैं।',
                    'en' => 'Please reach out using the official email, phone number, or visit the Multani Bhavan office in Udaipur during working hours as listed in the Contact section.',
                ],
                'order' => 5,
            ],
            [
                'question' => [
                    'hi' => 'सोसाइटी में दान या अंशदान करने की क्या प्रक्रिया है?',
                    'en' => 'What is the procedure to contribute or donate to the society?',
                ],
                'answer' => [
                    'hi' => 'सदस्य और दानदाता बैंक ट्रांसफर (NEFT/IMPS/UPI) या कार्यालय में सीधे चेक/नकद के माध्यम से सहयोग कर सकते हैं। प्रत्येक दान की अधिकृत रसीद तुरंत प्रदान की जाती है और बहीखाते में दर्ज की जाती है।',
                    'en' => 'Contributions can be made via bank transfer (NEFT/IMPS/UPI) or by cheque/cash at the society office. An official receipt is issued immediately for every contribution.',
                ],
                'order' => 6,
            ],
        ];

        foreach ($faqsData as $faq) {
            Faq::create($faq);
        }
    }
}
