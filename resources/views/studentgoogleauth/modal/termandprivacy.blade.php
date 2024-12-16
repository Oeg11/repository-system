<div class="modal fade" id="termandprivacy">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Consent Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">
             <p>
                <P>Before submitting your project or research output to STI Marikina Repository System, please review the
                    following waiver and provide your consent by checking the box below:</P>
                <br>
                <ul>
                    <li>I acknowledge that I am voluntarily submitting my capstone project or research
                        output to STI Marikina Repository System for the purpose of archiving and public
                        display within the institution’s repository system. I understand that my
                        submission may be accessible to authorized users of the platform.</li>
                    <br>
                    <li>I confirm that the submitted work is original, does not infringe on any third-party
                        intellectual property rights, and complies with all copyright laws. I accept full
                        responsibility for the content of my submission.</li>
                    <br>
                    <li>By submitting, I grant STI Marikina Repository System a non-exclusive,
                        perpetual license to store, display, and make my work accessible within the
                        platform. This includes the right to generate metadata and anonymized data for
                        indexing and academic research purposes</li>
                    <br>
                    <li>I understand that I may request the removal of my work from the repository by
                        submitting a written request to provided contact information.</li>
                    <br>
                    <li>I understand that STI Marikina Repository System is not liable for any
                        unauthorized access, misuse, or distribution of my submitted work by third
                        parties. I acknowledge that while security measures are in place, absolute security
                        cannot be guaranteed.</li>
                    <br>
                    <li>I have read and understood the terms outlined in this waiver and agree to proceed
                        with my submission</li>
                </ul>
             <p>

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary" id="btn-adddepartment">Save</button> --}}
        </div>
       </form>
      </div>
    </div>
  </div>
