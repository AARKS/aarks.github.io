			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar');

					}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->


				<ul class="nav nav-list">
					<li class="active">
						<a href="#">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<!-- Admin -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Admin
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Client Payment List
								</a>
								<b class="arrow"></b>
							</li>
                            @canany(['admin.user.create','admin.role.index'])
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    User Management
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu">
                                    @can('admin.user.create')
                                    <li class="">
                                        <a href="{{ route('user.index') }}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Users
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcan
                                    @can('admin.role.index')
                                    <li class="">
                                        <a href="{{route('role.index')}}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Roles
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcanany
                            @canany(['admin.profession.index'])
                                @can('admin.profession.index')
                                    <li class="">
                                        <a href="{{ route('profession.index') }}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Profession
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                @endcan
                            @endcanany

                            @canany(['admin.account-code.index', 'admin.account-code.create', 'admin.account-code.edit', 'admin.account-code.delete', 'admin.master-chart.index', 'admin.master-chart.create', 'admin.master-chart.edit', 'admin.master-chart.delete', 'admin.account-code.sub-category.create', 'admin.account-code.additional-category.create', 'admin.master-chart.sub-category.create', 'admin.master-chart.additional-category.create'])
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Code
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>
                                <ul class="submenu">
                                    @canany(['admin.account-code.index', 'admin.account-code.create', 'admin.account-code.edit', 'admin.account-code.delete', 'admin.account-code.sub-category.create', 'admin.account-code.additional-category.create'])
                                    <li class="">
                                        <a href="{{route('code')}}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                           Account Codes
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcanany
                                    @canany(['admin.master-chart.index', 'admin.master-chart.create', 'admin.master-chart.edit', 'admin.master-chart.delete', 'admin.master-chart.sub-category.create', 'admin.master-chart.additional-category.create'])
                                    <li class="">
                                        <a href="{{route('master.chart')}}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Master Chart
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcanany
                                </ul>
                            </li>
                            @endcanany
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Rules
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Fuel Tax Credit
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Tax Rate
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Payroll Table
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Coefficients
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>

							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Payroll
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Wages
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Superannuation
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Leave
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Deducation
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Employer Expenses
										</a>
										<b class="arrow"></b>
									</li>
								</ul>

							</li>
                            @canany(['admin.service.index', 'admin.service.create', 'admin.service.edit', 'admin.service.delete'])
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Services
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu">
                                    @can('admin.service.index')
                                    <li class="">
                                        <a href="{{route('service.index')}}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                           Services List
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcan
                                    @can('admin.service.create')
                                    <li class="">
                                        <a href="{{route('service.create')}}">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Add Services
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcanany

                            <li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Date Shorting
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<!-- Tools -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs" aria-hidden="true"></i>
							<span class="menu-text">
								Tools
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Verify Accounts
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Fixed Accounts
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Peroid Lock
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

                    @canany(['admin.client.create','admin.client.index'])
					<!-- Client List -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users" aria-hidden="true"></i>
							<span class="menu-text">
								Client
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                            @can('admin.client.index')
                            <li class="">
                                <a href="{{ route("client.index") }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Client List
                                </a>
                                <b class="arrow"></b>
                            </li>
                            @endcan
                            @can('admin.client.create')
							<li class="">
								<a href="{{ route('client.create') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Client
								</a>
								<b class="arrow"></b>
							</li>
                            @endcan
						</ul>
					</li>
                    @endcanany
					<!-- Add/Edit Data -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text">
								Add/Edit Data
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
                        @canany(['admin.period.index'])
						<ul class="submenu">
                            <li class="">
                                <a href="{{route('period.index')}}">
                                    <i class="menu-icon fa fa-download" aria-hidden="true"></i>
                                    <span class="menu-text">
								Period & Data
							</span>
                                </a>
                                <b class="arrow"></b>
                            </li>
                            @endcanany
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Bank Statement
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="{{route('bs_import.index')}}">
											<i class="menu-icon fa fa-caret-right"></i>
											Import
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="{{route('bs_input.index')}}">
											<i class="menu-icon fa fa-caret-right"></i>
											Input
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="{{route('bs_input.imp_tran_list.index')}}">
											<i class="menu-icon fa fa-caret-right"></i>
											Imp Trn List
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Journal Entry
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Journal List
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Deprecation
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Investment
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<!-- Close Year -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-close"></i>
							<span class="menu-text">
								Close Year
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Financial year close &amp; data backup</span>

								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Payroll year close &amp; data backup</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Data restore for financial year</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Data restore for payroll year</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Closed year report financial</span>
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color:red;">Closed year report payroll</span>
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<!-- Reports -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-clipboard" aria-hidden="true"></i>
							<span class="menu-text">
								Reports
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Cash Basis GTS/BAS
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Cash Periodic GTS/BAS
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Acctued Basis GTS/BAS
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Acctued Periodic GTS/BAS
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Profit &amp; Loss (GST <span style="color: red;">Excl</span>)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Profit &amp; Loss (GST <span style="color: red;">Incl</span>)
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Depreciation Report
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{route('general_ledger.index')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									General Ledger
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{route('trial-balance.index')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Trial Balance
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Balance Sheet
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Comperative Balance Sheet
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Ratio Analysis
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Financial Analysis
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color: green;">Consolidated Report</span>
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Cash Basis GST/BAS
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Accrud Basis GST/BAS
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Profit &amp; Loss (GST <span style="color: red;">Excl</span>)
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Profit &amp; Loss (GST <span style="color: red;">Incl</span>)
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Trial Balance
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Balance Sheet
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="#">
											<i class="menu-icon fa fa-caret-right"></i>
											Consolidated Completed Financial Report
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									<span style="color: blue;">Investment Report</span>
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<!-- Database Download -->
					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-download" aria-hidden="true"></i>
							<span class="menu-text">
								Database Download
							</span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
							<span class="menu-text">
								Calendar
							</span>
						</a>
						<b class="arrow"></b>
					</li>


					<!-- Agent Audit -->
					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-sign-out" aria-hidden="true"></i>
							<span class="menu-text">
								Agent Audit
							</span>
						</a>
						<b class="arrow"></b>
					</li>

					<!-- Logging Audit -->
					<li class="">
						<a href="#">
							<i class="menu-icon fa fa-sign-out" aria-hidden="true"></i>
							<span class="menu-text">
								Logging Audit
							</span>
						</a>
						<b class="arrow"></b>
					</li>

					<!-- Logout -->
					<li class="">
						<a href="{{route('admin.logout')}}">
							<i class="menu-icon fa fa-sign-out" aria-hidden="true"></i>
							<span class="menu-text">
								Logout
							</span>
						</a>
						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->


				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
