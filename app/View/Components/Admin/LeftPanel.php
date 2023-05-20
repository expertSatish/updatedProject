<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class LeftPanel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $homemanagement;
    public $others;
    public $schedules;
    public $wallet;
    public $helpcenter;
    public $aboutus;
    public $faqs;
    public $becomeanexpert;
    public $home;
    public $enquiry;
    public function __construct(){
        $this->enquiry = ['comments','jobs','contact','newsletter'];
        $this->helpcenter = ['help-center','add-help-center','edit-help-center','help-center-query'];
        $this->schedules = ['rejected','booked','expired','closed','reschedule'];
        $this->wallet = ['deposit','withdrawal','claim'];
        $this->home = ['home-expert-category','feqshomecms','home-expert-vidoes','featured','banner','bannercms','featuredcms','findexpertstepcms','find-expert-step','homeexpertcms','homeexpertcategorycms','hometestimonialcms','homenewscms','youanexpert'];
        $this->aboutus = ['teams','contact','contactcms','about','mission','vission','teamcms','addteams','editteams','privacy-policy','terms-condition'];
        $this->others = ['qualifications','expert-category','expertise','language','industry','role','working','getbetter','hearabout'];
        $this->faqs = ['faqs-category','faqcms','new-faqs-category','edit-faqs-category','faqs','new-faqs','edit-faqs'];
        $this->becomeanexpert = ['three-icons','testimonials','addtestimonial','edittestimonial','testimonialcms','mentor','memtorcms','callingprocesscms','calling-process','become-an-expert-banner','become-an-expert-content','become-an-expert-about'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.left-panel');
    }
}
